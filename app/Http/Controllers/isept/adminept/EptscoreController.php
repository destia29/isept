<?php

namespace App\Http\Controllers\isept\adminept;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Ept;
use App\Model\Type;
use App\Model\Score;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;

class EptscoreController extends Controller
{
    public function index(){
        $eptscorelist = DB::table('eptscore as score')
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->where('ept_.ept_date', '>=', Carbon::today()->subWeek().' 00:00:00')
        ->orderBy('faculty.id', 'DESC')
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
		    $type = Type::where('deleted_at', NULL)->get();
        $vardatein1 = 'new';
        // dd(Carbon::today()->subWeek());
        $page ='neweptscore';
        return view('isept.adminept.eptscore')->with([
			       'eptscorelist'      => $eptscorelist,
             'type'          => $type,
             'vardatein1'    => $vardatein1,
             'page'          => $page,
        ]);
    }

    public function findscore(){
      $type = Type::where('deleted_at', NULL)->get();
      $page ='findscore';
      return view('isept.adminept.findeptscore', compact(['type', 'page']));
    }

    public function findscoreselectdate(Request $req){
        $searchtype = $req->ept_type;

        $searchdate = date('Y-m-d', strtotime($req->ept_date));
        $vardate    = date('F j, Y', strtotime($req->ept_date));
        $vardatein1 = NULL;
        // dd($searchdate);
        $eptscorelist = DB::table('eptscore as score')
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->where('ept_.ept_date', $searchdate)
        ->orderBy('faculty.id', 'DESC')
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
        $type = Type::where('deleted_at', NULL)->get();

        // dd($eptscore);

        $page ='findscore';
        return view('isept.adminept.eptscore', compact(['page', 'searchdate', 'searchtype', 'eptscorelist', 'type', 'vardatein1', 'vardate']));
    }

    public function findscoreselectcustomdate(Request $req){
        $searchtype     = $req->ept_type;
        $searchdateint1 = date('Y-m-d', strtotime($req->ept_dateint1));
        $searchdateint2 = date('Y-m-d', strtotime($req->ept_dateint2));
        $vardatein1     = date('F j, Y', strtotime($req->ept_dateint1));
        $vardatein2     = date('F j, Y', strtotime($req->ept_dateint2));
        // dd($searchdate);
        $eptscorelist = DB::table('eptscore as score')
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->whereBetween('ept_.ept_date', [$searchdateint1, $searchdateint2])
        ->orderBy('faculty.id', 'DESC')
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
        $type = Type::where('deleted_at', NULL)->get();

        $page ='findscore';
        return view('isept.adminept.eptscore', compact(['page', 'type', 'searchdateint1', 'searchdateint2', 'searchtype', 'eptscorelist', 'vardatein1', 'vardatein2']));
    }

    public function alleptscore(){
        $eptscorelist = DB::table('eptscore as score')
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->orderBy('faculty.id', 'DESC')
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
        $vardatein1 = 'all';
		    $type = Type::where('deleted_at', NULL)->get();
        // dd($adminuser);
        $page ='findscore';
        return view('isept.adminept.eptscore')->with([
			       'eptscorelist'  => $eptscorelist,
             'type'          => $type,
             'page'          => $page,
             'vardatein1'    => $vardatein1,
        ]);
    }

    public function export(Request $req){
      $this->validate($req, [
        'ept_date'  => 'required',
      ]);

      $eptscorelist = DB::table('eptscore as score')
      ->select([
          'reg.qr_code as qr_code',
          'reg.id as reg_id',
          'reg.status as status',
          'reg.id_eptparticipant as eptpartid',
          'ept_.id as ept_id',
          'eptpart.id as eptpart_id',
          'eptpart.date_of_birth as birthdate',
          'eroom.room_name as roomname',
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
      ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
      ->leftjoin('eptroom as eroom', 'avs.id_eptroom', '=', 'eroom.id')
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


      //

      $type_file = $req->type_file;
      // $date = Carbon::today();
      $eptdate = EPT::where('ept_date', $req->ept_date)->distinct('ept_date')->get();
      // dd($req->ept_date);
      $date=$req->ept_date;
      $excel  = Excel::create('LCUnila-'.'eptscorelist-'.date('d-m-Y', strtotime($date)), function($excel) use ($eptscorelist, $date, $type_file) {

         $excel->setTitle('Recapitulation of EPT Score on'.date('d-m-Y', strtotime($date)));
         $excel->setCreator('David Abror');
         $excel->setLastModifiedBy(Auth::user()->nama);
         $excel->setManager("David Abror");
         $excel->setCompany("Ryu Consolidated");

        $excel->sheet('Sheet1', function($sheet) use ($eptscorelist, $type_file) {
          $sheet->setAllBorders('solid');
          $sheet->loadView('isept.adminept.export_'.$type_file)->with([
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
      ->select([
          'reg.qr_code as qr_code',
          'reg.id as reg_id',
          'reg.status as status',
          'reg.id_eptparticipant as eptpartid',
          'ept_.id as ept_id',
          'eptpart.id as eptpart_id',
          'eptpart.date_of_birth as birthdate',
          'eroom.room_name as roomname',
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
      ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
      ->leftjoin('eptroom as eroom', 'avs.id_eptroom', '=', 'eroom.id')
      ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
      ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
      ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
      ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
      ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
      ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
      ->whereNotIn('status', ['Abandoned', 'Unverified'])
      ->where('ept_date', $ept_date2)
      ->orderBy('faculty.id', 'DESC')
      ->orderBy('major.id', 'DESC')
      ->get();


      //

      $type_file = $req->type_file;
      $date=$req->ept_date;
      $eptdate = $req->ept_date;

      $excel  = Excel::create('LCUnila-'.'eptscorelist-'.date('d-m-Y', strtotime($date)), function($excel) use ($eptscorelist, $date, $type_file) {

         $excel->setTitle('Recapitulation of EPT Score on'.date('d-m-Y', strtotime($date)));
         $excel->setCreator('David Abror');
         $excel->setLastModifiedBy(Auth::user()->nama);
         $excel->setManager("David Abror");
         $excel->setCompany("Ryu Consolidated");

        $excel->sheet('Sheet1', function($sheet) use ($eptscorelist, $type_file) {
          $sheet->setAllBorders('solid');
          $sheet->loadView('isept.adminept.export_'.$type_file)->with([
           'eptscorelist' => $eptscorelist,
          ]);
        });

      })->download($req->type_file);
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
