<?php

namespace App\Http\Controllers\isept\admindekanat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Adminuser;
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

class EptscoreController extends Controller
{


    public function index(){
      $alias = explode(' ', Auth::user()->adminuser->position);
        $eptscore = DB::table('eptscore as score')
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->where('faculty.faculty_alias', $alias[2])
        ->where('ept_.ept_date', '>=', Carbon::today()->subWeek().' 00:00:00')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
		    $type = Type::where('deleted_at', NULL)->get();
        $page ='neweptscore';
        return view('isept.admindekanat.eptscore')->with([
			       'eptscore'   => $eptscore,
             'page'       => $page,
             'type'       => $type,
        ]);
    }

    public function findscore(){
      $type = Type::where('deleted_at', NULL)->get();
      $page ='findscore';
      return view('isept.admindekanat.findeptscore', compact(['type', 'page']));
    }

    public function findscoreselectdate(Request $req){
      $alias = explode(' ', Auth::user()->adminuser->position);
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
        ->where('faculty.faculty_alias', $alias[2])
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->where('ept_.ept_date', $searchdate)
        ->orderBy('faculty.id', 'DESC')
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
        $type = Type::where('deleted_at', NULL)->get();

        // dd($eptscore);

        $page ='findscore';
        return view('isept.admindekanat.eptscore', compact(['page', 'searchdate', 'searchtype', 'eptscore', 'type', 'vardatein1', 'vardate']));
    }

    public function findscoreselectcustomdate(Request $req){
      $alias = explode(' ', Auth::user()->adminuser->position);
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
        ->where('faculty.faculty_alias', $alias[2])
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->whereBetween('ept_.ept_date', [$searchdateint1, $searchdateint2])
        ->orderBy('faculty.id', 'DESC')
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
        $type = Type::where('deleted_at', NULL)->get();

        $page ='findscore';
        return view('isept.admindekanat.eptscore', compact(['page', 'type', 'searchdateint1', 'searchdateint2', 'searchtype', 'eptscore', 'vardatein1', 'vardatein2']));
    }

    public function alleptscore(){
      $alias = explode(' ', Auth::user()->adminuser->position);
        $eptscore = DB::table('eptscore as score')
        ->leftjoin('registerept as reg', 'score.id_registerept', '=', 'reg.id')
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->where('faculty.faculty_alias', $alias[2])
        ->whereNotIn('status', ['Abandoned'])
        ->orderBy('major.id', 'DESC')
        ->orderBy('score.total_score', 'DESC')
        ->get();
		    $type = Type::where('deleted_at', NULL)->get();
        $page ='findscore';
        return view('isept.admindekanat.eptscore')->with([
			       'eptscore'      => $eptscore,
             'type'          => $type,
             'page'          => $page,
        ]);
    }
}
