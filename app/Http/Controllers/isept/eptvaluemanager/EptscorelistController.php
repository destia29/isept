<?php

namespace App\Http\Controllers\isept\eptvaluemanager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Faculty;
use App\Model\Type;
use App\Model\Major;
use App\Model\Ept;
use App\Model\Score;
use Storage;
use Redirect;
use Auth;
use DB;
use Carbon\Carbon;
use Excel;

class EptscorelistController extends Controller
{
    public function index(){
        $eptscorelist = DB::table('eptscore as score')
        ->select([
          'reg.id as reg_id',
          'score.id as score_id',
          'score.takecourse as score_takecourse',
          'score.listening_score as listening_score',
          'score.reading_score as reading_score',
          'score.structure_score as structure_score',
          'score.total_score as total_score',
          'reg.status as status',
          'ept_.id as ept_id',
          'ept_type.type as type',
          'eptpart.id as eptpart_id',
          'user.name as user_name',
          'ept_.ept_date as ept_eptdate',
          'ept_.ept_time as ept_epttime',
          'ept_.registration_date as ept_registrationdate',
          'eptpart.idnumber_eptparticipant as eptpart_idnumber',
          'faculty.faculty_alias as faculty_alias',
          'major.id as id_major',
          'major.major_name as major_name',
          'reg.attempt as attempt',
        ])
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->get();
		    $type = Type::where('deleted_at', NULL)->get();
        // dd($adminuser);
        $page ='eptscorelist';
        return view('isept.eptvaluemanager.eptscorelist')->with([
			      'eptscorelist'  => $eptscorelist,
            'type'          => $type,
            'page'          => $page,
        ]);
    }

  public function export(Request $req){
    $this->validate($req, [
      'ept_date'  => 'required',
      'type_file'  => 'required',
    ]);

    $eptscorelist = DB::table('eptscore as score')
    ->select([
        'reg.qr_code as qr_code',
        'reg.id as reg_id',
        'reg.status as status',
        'reg.id_eptparticipant as eptpartid',
        'ept_.id as ept_id',
        'eptpart.id as eptpart_id',
        'user.name as user_name',
        'score.listening_score as listening_score',
        'score.structure_score as structure_score',
        'score.reading_score as reading_score',
        'score.total_score as total_score',
        'score.takecourse as takecourse',
        'score.certif_code as certif_code',
        'ept_.ept_date as ept_eptdate',
        'ept_.id_epttype as type',
        'ept_.ept_time as ept_epttime',
        'ept_.registration_date as ept_registrationdate',
        'eptpart.idnumber_eptparticipant as eptpart_idnumber',
        'faculty.faculty_alias as faculty_alias',
        'major.id as id_major',
        'major.major_name as major_name',
        'reg.attempt as attempt',
      ])

    ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
    ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
    ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
    ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
    ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
    ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
    ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
    ->whereNotIn('status', ['Abandoned', 'Unverified'])
    ->where('ept_date', $req->ept_date)
    ->orderBy('faculty.id', 'DESC')
    ->orderBy('major.id', 'DESC')
    ->get();

    $type_file = $req->type_file;
    $date = Carbon::today();
    $excel  = Excel::create('LCUnila-'.'eptscorelist-'.$date->format('d-m-Y'), function($excel) use ($eptscorelist, $date, $type_file) {

       $excel->setTitle('Recapitulation of EPT Score on'.$date->format('d F Y'));
       $excel->setCreator('David Abror');
       $excel->setLastModifiedBy(Auth::user()->nama);
       $excel->setManager("David Abror");
       $excel->setCompany("Ryu Consolidated");

      $excel->sheet('Sheet1', function($sheet) use ($eptscorelist, $type_file) {
        $sheet->setAllBorders('solid');
        $sheet->loadView('isept.eptvaluemanager.export_'.$type_file)->with([
         'eptscorelist' => $eptscorelist,
        ]);
      });

    })->download($req->type_file);
  }

    public function import(Request $req){
      $this->validate($req, [
        'file_import'  		=> 'required'
      ]);

      $file     		= $req->file('file_import');

    	$test = Excel::load($file, function($render){
      $result		= $render->get();
        foreach ($result as $key => $value) {
          $code   = NULL;
          $check = DB::table('registerept as reg')
          ->select([
            'reg.id as reg_id',
            'score.id as eptscore_id',
            'score.total_score as total_score',
            'code_.id as code_id',
            'code_.code as codecer',
            'reg.code as code',
            'ept_.ept_date as ept_date',
            'ept_.id_epttype as id_epttype',
          ])
          ->leftjoin('eptscore as score', 'id_registerept', '=', 'reg.id')
          ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
          ->leftjoin('eptcode as code_', 'ept_.id_epttype', '=', 'code_.id')
          ->where('reg.id', $value->id_registerept)
          ->first();

          $geteptreg  = substr($check->code, 5);

          $start_of_month   = Carbon::createFromFormat("Y-m-d", $check->ept_date)->startOfMonth();
          $end_of_month     = Carbon::createFromFormat("Y-m-d", $check->ept_date)->endOfMonth();

          $check2           = Ept::select('id')->whereBetween('ept_date', [$start_of_month, $end_of_month])->where('id_epttype', $check->id_epttype)->pluck('id')->toArray();

          $check3           = Registerept::select('id')->whereIn('id_ept', $check2)->whereNull('deleted_at')->get()->pluck('id')->toArray();
          // $check3         = Registerept::with('id')->whereNull('deleted_at')->get()->pluck('id')->toArray();
          $getLatestCode    = Score::select('certif_code')->whereIn('id_registerept', $check3)->whereNotNull('certif_code')->orderBy('certif_code', 'DESC')->first();
          // dd($check);
          // dd($getLatestCode);
          // dd($check->total_score);
          if($check->id_epttype == 1) {
            if($value->total_score >= 210) {
              if (empty($getLatestCode)) {
                $code   = sprintf('%04d', 1).'-'.$geteptreg.$check->codecer;
                  // $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code.$update->ept->code_ept->code;
              }else{
                $nomor  = substr($getLatestCode->certif_code, 0, 4);
                $x      = intval(str_replace('0', '', $nomor));
                $code   = sprintf('%04d', $x+1).'-'.$geteptreg.$check->codecer;
              }
            }
            else{
              $code   = NULL;
              $updatetemp = Score::where('id_registerept', $value->id_registerept)->first();
              $updatetemp->certif_code = $code;
              $updatetemp->save();
            }
          }
          elseif($check->id_epttype == 2){
            if($value->total_score >= 210) {
              if (empty($getLatestCode)) {
                $code   = sprintf('%04d', 1).'-'.$geteptreg.$check->codecer;
                  // $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code.$update->ept->code_ept->code;
              }else{
                $nomor  = substr($getLatestCode->certif_code, 0, 4);
                $x      = intval(str_replace('0', '', $nomor));
                $code   = sprintf('%04d', $x+1).'-'.$geteptreg.$check->codecer;
              }
            }
            else{
              $code   = NULL;
              $updatetemp = Score::where('id_registerept', $value->id_registerept)->first();
              $updatetemp->certif_code = $code;
              $updatetemp->save();
            }
          }
          // dd($code);
          // $update->certif_code = $code;

          $update2 = Score::where('id_registerept', $value->id_registerept)->first();
          $update2->listening_score = $value->listening_score;
          $update2->structure_score = $value->structure_score;
          $update2->reading_score = $value->reading_score;
          $update2->total_score = $value->total_score;
          $update2->takecourse = $value->takecourse;
          if (empty($update2->certif_code)) {
            $update2->certif_code = $code;
          }
          $update2->save();

        }
      });

      return back()->with('success', "Import data succesfull");
    }


  	public function postEdit(Request $req){
  		$this->validate($req, [
        'listening_score'		=> 'required|string|max:2',
  			'structure_score'   => 'required|string|max:2',
  			'reading_score'		  => 'required|string|max:2',
  			'total_score'		    => 'required|string|max:3',
  			'take_course'		    => 'required|string',
  		]);

      $check = DB::table('registerept as reg')
      ->select([
        'reg.id as reg_id',
        'score.id as eptscore_id',
        'score.total_score as total_score',
        'code_.id as code_id',
        'code_.code as codecer',
        'reg.code as code',
        'ept_.ept_date as ept_date',
        'ept_.id_epttype as id_epttype',
      ])
      ->leftjoin('eptscore as score', 'id_registerept', '=', 'reg.id')
      ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
      ->leftjoin('eptcode as code_', 'ept_.id_epttype', '=', 'code_.id')
      ->where('score.id', $req->id_score)
      ->first();
      // dd($check->codecer);
      $geteptreg  = substr($check->code, 5);
      // dd($geteptreg);

      $start_of_month = Carbon::createFromFormat("Y-m-d", $check->ept_date)->startOfMonth();
      $end_of_month   = Carbon::createFromFormat("Y-m-d", $check->ept_date)->endOfMonth();

      $check2         = Ept::select('id')->whereBetween('ept_date', [$start_of_month, $end_of_month])->where('id_epttype', $check->id_epttype)->pluck('id')->toArray();

      $check3         = Registerept::select('id')->whereIn('id_ept', $check2)->whereNull('deleted_at')->get()->pluck('id')->toArray();
      // $check3         = Registerept::with('id')->whereNull('deleted_at')->get()->pluck('id')->toArray();
      $getLatestCode  = Score::select('certif_code')->whereIn('id_registerept', $check3)->whereNotNull('certif_code')->orderBy('certif_code', 'DESC')->first();
      // dd($check);
      // dd($getLatestCode);
      // dd($check->total_score);
      // dd($geteptreg);
      if($check->id_epttype == 1) {
        if($req->total_score >= 210) {
          if (empty($getLatestCode)) {
            $code   = sprintf('%04d', 1).'-'.$geteptreg.$check->codecer;
              // $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code.$update->ept->code_ept->code;
          }else{
            $nomor  = substr($getLatestCode->certif_code, 0, 4);
            $x      = intval(str_replace('0', '', $nomor));
            $code   = sprintf('%04d', $x+1).'-'.$geteptreg.$check->codecer;
          }
        }
        else{
          $code   = NULL;
          $updatetemp = Score::find($req->id_score);
          $updatetemp->certif_code = $code;
          $updatetemp->save();
        }
      }
      elseif($check->id_epttype == 2){
        if($req->total_score >= 210) {
          if (empty($getLatestCode)) {
            $code   = sprintf('%04d', 1).'-'.$geteptreg.$check->codecer;
              // $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code.$update->ept->code_ept->code;
          }else{
            $nomor  = substr($getLatestCode->certif_code, 0, 4);
            $x      = intval(str_replace('0', '', $nomor));
            $code   = sprintf('%04d', $x+1).'-'.$geteptreg.$check->codecer;
          }
        }
        else{
          $code   = NULL;
          $updatetemp = Score::find($req->id_score);
          $updatetemp->certif_code = $code;
          $updatetemp->save();
        }
      }
      // dd($code);
      // $update->certif_code = $code;

      $update2 = Score::find($req->id_score);
      $update2->listening_score = $req->listening_score;
      $update2->structure_score = $req->structure_score;
      $update2->reading_score = $req->reading_score;
      $update2->total_score = $req->total_score;
      $update2->takecourse = $req->take_course;
      if (empty($update2->certif_code)) {
        $update2->certif_code = $code;
      }
      $update2->save();

      if ($update2) {
        return Redirect::to('isept/eptvaluemanager/eptscorelist')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change data");
      }
    }

    public function edit($id){
        $edit = Score::with(['registerept'])->where('id', $id)->first();

        // dd($adminuser);
        $page ='eptscorelist';
        return view('isept.eptvaluemanager.editeptscore', compact('page'))->with([
			       'edit'    		        => $edit,
             'page'               => $page,
        ]);
    }

    public function refresh($id){

		$update = Score::where('id', $id)->first()->update([
            'listening_score'          => NULL,
            'structure_score'          => NULL,
            'reading_score'            => NULL,
            'total_score'              => NULL,
            'takecourse'               => "No",
            'certif_code'              => NULL,
        ]);
		return back()->with('success', "Data  was successfully refreshed");
    }

    public function takecourse($id){
    		$update = Score::where('id', $id)->first()->update([
                'takecourse'               => "Yes",
            ]);
    		return back()->with('success', "Data  was updated");
    }

    public function getPictureProfile($name){
        $photo = Storage::disk('eptparticipant_photoprofile')->get($name);

        return $photo;
    }

    public function searchEptType(Request $req){
        $type = Type::where('id', $req->val)->first();
        $data['cost'] = $type->modif_cost;
        $data['type'] = Ept::select(['ept_date'])->where('id_epttype', $req->val)->get();

        return response()->json($data);
    }

    public function searchEptDate(Request $req){
        $data = Ept::select(['id', 'ept_time'])->where('ept_date', $req->val)->get();

        return response()->json($data);
	}
}
