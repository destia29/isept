<?php

namespace App\Http\Controllers\islcunila\chiefoftheboard;

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

public function neweptscore(){
    $eptscore = DB::table('eptscore as score')
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
    // dd($adminuser);
    $page ='neweptscore';
    return view('isclunila.chiefoftheboard.eptscore')->with([
        'eptscore'      => $eptscore,
        'type'          => $type,
        'page'          => $page,
    ]);
}

public function findscore(){
  $type = Type::where('deleted_at', NULL)->get();
  $page ='findeptscore';
  return view('isclunila.chiefoftheboard.findeptscore', compact(['type', 'page']));
}

public function findscoreselectdate(Request $req){
    $searchtype = $req->ept_type;

    $searchdate = date('Y-m-d', strtotime($req->ept_date));
    $vardate    = date('F j, Y', strtotime($req->ept_date));
    $vardatein1 = NULL;
    // dd($searchdate);
    $eptscore = DB::table('eptscore as score')
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

    $page ='findeptscore';
    return view('isclunila.chiefoftheboard.eptscore', compact(['page', 'searchdate', 'searchtype', 'eptscore', 'type', 'vardatein1', 'vardate']));
}

public function findscoreselectcustomdate(Request $req){
    $searchtype     = $req->ept_type;
    $searchdateint1 = date('Y-m-d', strtotime($req->ept_dateint1));
    $searchdateint2 = date('Y-m-d', strtotime($req->ept_dateint2));
    $vardatein1     = date('F j, Y', strtotime($req->ept_dateint1));
    $vardatein2     = date('F j, Y', strtotime($req->ept_dateint2));
    // dd($searchdate);
    $eptscore = DB::table('eptscore as score')
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

    $page ='findeptscore';
    return view('isclunila.chiefoftheboard.eptscore', compact(['page', 'type', 'searchdateint1', 'searchdateint2', 'searchtype', 'eptscore', 'vardatein1', 'vardatein2']));
}

public function alleptscore(){
    $eptscore = DB::table('eptscore as score')
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
    $type = Type::where('deleted_at', NULL)->get();
    // dd($adminuser);
    $page ='findeptscore';
    return view('isclunila.chiefoftheboard.eptscore')->with([
        'eptscore'      => $eptscore,
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

// dd($eptscorelist);

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
->whereNotIn('status', ['Abandoned', 'Unverified'])
->where('ept_date', $ept_date2)
->orderBy('faculty.id', 'DESC')
->orderBy('major.id', 'DESC')
->get();

// dd($eptscorelist);

$type_file = $req->type_file;
$date = Carbon::today();
$excel  = Excel::create('LCUnila-'.'eptscorelist-'.$date->format('d-m-Y'), function($excel) use ($eptscorelist, $date, $type_file) {

   $excel->setTitle('Recapitulation of EPT Score on'.$ept_date2->format('d F Y'));
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
