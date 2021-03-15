<?php

namespace App\Http\Controllers\islcunila;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Adminuser;
use App\Model\Ept;
use App\Model\Type;
use App\Model\Score;
use Storage;
use Auth;
use DB;
use PDF;
use Excel;
use Carbon\Carbon;

class EptresultController extends Controller
{
    public function index(){
        $faculty = Faculty::where('deleted_at', NULL)->get();
        $myprofile = DB::table('registerept as reg')
        ->select([
          'reg.id as reg_id',
          'reg.status as status',
          'ept_.id as ept_id',
          'ept_room.room_name as room_name',
          'eptpart.id as eptpart_id',
          'user.name as user_name',
          'ept_type.type as type',
          'ept_.ept_date as ept_eptdate',
          'ept_.ept_time as ept_epttime',
          'ept_.registration_date as ept_registrationdate',
          'eptpart.idnumber_eptparticipant as eptpart_idnumber',
          'faculty.faculty_name as faculty_name',
          'major.id as id_major',
          'major.major_name as major_name',
          'reg.attempt as attempt',
        ])
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('eptscore as src', 'reg.id', '=', 'src.id_registerept')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
        ->leftjoin('eptroom as ept_room', 'avs.id_eptroom', '=', 'ept_room.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->where('id_user', Auth::id())
        ->orderBy('attempt', 'DESC')
        ->orderBy('reg.id', 'DESC')
        ->get();
        $page ='myprofile';
        return view('isept.eptparticipant.myprofile')->with([
			      'myprofile'     => $myprofile,
            'faculty'       => $faculty,
            'page'          => $page,
        ]);
    }
    	public function postEdit(Request $req){
    		$this->validate($req, [
          			'name'		          => 'required|string|max:100',
          			'email'		          => 'required|string|max:100',
          			'username'		      => 'required|string',
          			'p_type'            => 'required|string',
          			'place_of_birth'    => 'required|string',
          			'date_of_birth'     => 'required|string',
          			'gender'            => 'required|string',
          			'handphone_number'  => 'required|string',
    		]);
            if ($req->profile_picture && $req->profile_picture_name != 'default.png') {
               Storage::disk('eptparticipant_photoprofile')->delete($req->profile_picture_name);
            }

            if ($req->profile_picture) {
                $file=$req->profile_picture;
    		    		$nameRaw=$file->getClientOriginalName();
    		    		$profile_picture_name=mt_rand(10000, 99999).'-'.$nameRaw;
    		    		Storage::disk('eptparticipant_photoprofile')->put($profile_picture_name, file_get_contents($file));
            }
            else{
                $profile_picture_name = $req->profile_picture_name;
            }

            if ($req->p_type == 1) {
                $major = NULL;
            }
            elseif ($req->p_type == 2) {
                $major = $req->id_major;
            }
    		    $checkUsername = User::where('username', $req->username)->where('id', '!=', $req->id_user)->first();

    		    if (!empty($checkUsername)) {
    		      return back()->with('warning', "Username has already taken");
    		    }

    				$update = User::find($req->id_user)->update([
    						'username'          => $req->username,
                'name'              => $req->name,
                'email'             => $req->email,
            ]);

    	      $update2 = Eptparticipant::find($req->id_eptparticipant)->update([
                'id_major'          => $major,
          			'place_of_birth'    => $req->place_of_birth,
          			'date_of_birth'     => date('Y-m-d', strtotime($req->date_of_birth)),
          			'gender'            => $req->gender,
          			'handphone_number'  => $req->handphone_number,
          			'address'           => $req->address,
    	          'profile_picture'   => $profile_picture_name,
    	      ]);

    				if ($update2) {
    					return back()->with('success', "Data Has been changed");
    				}
    				else{
    					return back()->with('danger', "Failed change Data");
    				}
        }

        public function export(Request $req){
          $this->validate($req, [
            'ept_date'  => 'required',
          ]);

          $eptscorelist = DB::table('eptscore as score')
          ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
          ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
          ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
          ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
          ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
          ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
          ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
          ->whereNotIn('status', ['Abandoned'])
          ->where('ept_date', $req->ept_date)
          ->orderBy('faculty.id', 'DESC')
          ->orderBy('major.id', 'DESC')
          ->get();

          // dd($eptscorelist);

          $type_file = $req->type_file;
          $date = Carbon::today();
          $eptdate = EPT::where('ept_date', $req->ept_date)->distinct('ept_date')->get();
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

        public function exportselected(Request $req){
          $this->validate($req, [
            'ept_date'   => 'required',
            'type_file'  => 'required',
          ]);

          $ept_date2 = date('Y-m-d', strtotime($req->ept_date));
          $eptscorelist = DB::table('eptscore as score')
          ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
          ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
          ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
          ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
          ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
          ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
          ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
          ->whereNotIn('status', ['Abandoned'])
          ->where('ept_date', $ept_date2)
          ->orderBy('faculty.id', 'DESC')
          ->orderBy('major.id', 'DESC')
          ->get();

          dd($eptscorelist);

          $type_file = $req->type_file;
          $date = Carbon::today();
          $eptdate = $req->ept_date;
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

        public function exportfaculty(Request $req){
          $alias = explode(' ', Auth::user()->adminuser->position);

          $this->validate($req, [
            'ept_date'   => 'required',
            'type_file'  => 'required',
          ]);

          $ept_date2 = date('Y-m-d', strtotime($req->ept_date));
          $eptscorelist = DB::table('eptscore as score')
          ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
          ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
          ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
          ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
          ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
          ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
          ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
          ->whereNotIn('status', ['Abandoned'])
          ->where('ept_date', $ept_date2)
          ->where('faculty.faculty_alias', $alias[2])
          ->orderBy('faculty.id', 'DESC')
          ->orderBy('major.id', 'DESC')
          ->get();

          dd($eptscorelist);

          $type_file = $req->type_file;
          $date = Carbon::today();
          $eptdate = $req->ept_date;
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

      	public function vieweptresult(Request $req){
          $page ='neweptscore';
      		return view('isept.vieweptresult')->with([
      			'id'		      => $req->ept_date2,
            'page'        => $page,
      		]);
      	}

      	public function streameptresult($id){
      		$eptresult	      = Ept::find($id);
          $testdate         = Ept::where('ept_date', $eptresult->ept_date)->where('id_epttype', $eptresult->id_epttype)->get();
          $idEpt            = Ept::select(['id'])->where('ept_date', $eptresult->ept_date)->where('id_epttype', $eptresult->id_epttype)->get()->toArray();
          $eptparticipant   = Registerept::whereIn('id_ept', $idEpt)->get();
          $reg              = Registerept::select('id')->whereIn('id_ept', $idEpt)->get()->toArray();
          // dd($reg);
          // dd($eptparticipant);
          $type             = Type::where('id', $eptresult->id_epttype)->first();
          $headoflcunila    = Adminuser::with(['user'])->where('position', 'Head of LC Unila')->first();
          $eptscore         = Score::whereIn('id_registerept', $reg)->orderBy('total_score', 'DESC')->get();

          // $eptscore         = DB::table('eptscore as score')
          // ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
          // ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
          // ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
          // ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
          // ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
          // ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
          // ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
          // ->whereIn('status', ['Verified', 'Done'])
          // ->whereIn('id_registerept', $reg)
          // ->orderBy('faculty.id', 'DESC')
          // ->orderBy('major.id', 'DESC')
          // ->orderBy('total_score', 'DESC')
          // ->get();

          // dd($eptscore);
          // dd($headoflcunila);
          $time = Carbon::today();
      		$pdf        = PDF::loadView('isept.document.eptresult', compact(['eptscore', 'eptresult', 'time', 'headoflcunila', 'testdate', 'type', 'eptparticipant']))->setOptions(['isRemoteEnabled' => true])->setPaper('a4', 'potrait');
      		$filename   = $eptresult->code;
          // if ($req->p_type == 1) {
          //     $major = NULL;
          // }
          // elseif ($req->p_type == 2) {
          //     $major = $req->id_major;
          // }

      		return $pdf->stream($filename.'.pdf');
      	}

      	public function vieweptresultselected(Request $req){
          $page ='alleptscore';
      		return view('isept.vieweptresultselected')->with([
            'epttype'     => $req->ept_type2,
      			'name'		    => date('Y-m-d', strtotime($req->ept_date)),
            'page'        => $page,
      		]);
      	}

      	public function streameptresultselected($name){

          // dd($name);
      		$eptresult	      = Ept::where('ept_date', $name)->first();
          $testdate         = Ept::where('ept_date', $name)->where('id_epttype', $eptresult->id_epttype)->get();
          $idEpt            = Ept::select(['id'])->where('ept_date', $name)->where('id_epttype', $eptresult->id_epttype)->get()->toArray();
          $eptparticipant   = Registerept::whereIn('id_ept', $idEpt)->get();
          $reg              = Registerept::select('id')->whereIn('id_ept', $idEpt)->get()->toArray();
          // dd($reg);
          // dd($eptparticipant);
          $type             = Type::where('id', $eptresult->id_epttype)->first();
          $headoflcunila    = Adminuser::with(['user'])->where('position', 'Head of LC Unila')->first();
          $eptscore         = Score::whereIn('id_registerept', $reg)->orderBy('total_score', 'DESC')->get();
          // dd($eptscore);
          // dd($headoflcunila);
          $time = Carbon::today();
      		$pdf        = PDF::loadView('isept.document.eptresult', compact(['eptscore', 'eptresult', 'time', 'headoflcunila', 'testdate', 'type', 'eptparticipant']))->setOptions(['isRemoteEnabled' => true])->setPaper('a4', 'potrait');
      		$filename   = $eptresult->code;
          // if ($req->p_type == 1) {
          //     $major = NULL;
          // }
          // elseif ($req->p_type == 2) {
          //     $major = $req->id_major;
          // }

      		return $pdf->stream($filename.'.pdf');
      	}
}
