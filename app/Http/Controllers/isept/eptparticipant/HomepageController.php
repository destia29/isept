<?php

namespace App\Http\Controllers\isept\eptparticipant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Ept;
use App\Model\Score;
use Carbon\Carbon;
use Auth;
use DB;

class HomepageController extends Controller
{
    public function index(){
        $graphic_1 = DB::select("
        SELECT * FROM(
          SELECT
            DATE_FORMAT(ept.ept_date, '%M %e, %Y') as y,
            es.listening_score as a,
            es.structure_score as b,
            es.reading_score as c
          FROM registerept as regist
          LEFT JOIN ept ON regist.id_ept = ept.id
          LEFT JOIN eptscore as es ON es.id_registerept = regist.id
          WHERE regist.id_eptparticipant = '".Auth::user()->eptparticipant->id."'
          AND es.total_score IS NOT NULL
          ORDER BY ept.ept_date DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");

        $graphic_2 = DB::select("
        SELECT * FROM(
          SELECT
            ept.ept_date as y,
            es.total_score as a
          FROM registerept as regist
          LEFT JOIN ept ON regist.id_ept = ept.id
          LEFT JOIN eptscore as es ON es.id_registerept = regist.id
          WHERE regist.id_eptparticipant = '".Auth::user()->eptparticipant->id."'
          AND es.total_score IS NOT NULL
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");
        // dd($graphic_2);

        $mytest = DB::table('registerept as reg')
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

        $eptest = DB::table('registerept as reg')
        ->select([
          'reg.id as reg_id',
          'reg.status as status',
          'reg.updated_at as regupdated_at',
          'reg.id_eptparticipant as eptpartid',
          'ept_.id as ept_id',
          'ept_room.room_name as room_name',
          'eptpart.id as eptpart_id',
          'user.name as user_name',
          'ept_.ept_date as ept_eptdate',
          'ept_.ept_time as ept_epttime',
          'ept_.registration_date as ept_registrationdate',
          'eptpart.idnumber_eptparticipant as eptpart_idnumber',
        ])
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
        ->leftjoin('eptroom as ept_room', 'avs.id_eptroom', '=', 'ept_room.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->whereNotIn('status', ['Abandoned', 'Done'])
        ->where('reg.id_eptparticipant', Auth::user()->eptparticipant->id)
        ->where('ept_date', '>=', Carbon::today().' 00:00:00')
        ->orderBy('regupdated_at', 'DESC')
        ->first();
        if($eptest != NULL){
          $gettimereg = Carbon::parse($eptest->ept_registrationdate)->addHours(24)->subHour(11);
          $getdatetest = Carbon::parse($eptest->ept_eptdate);
          $gettimetest = Carbon::parse($eptest->ept_epttime);
        }
        else{
          $gettimereg  = NULL;
          $getdatetest = NULL;
          $gettimetest = NULL;
        }

        if(Auth::user()->eptparticipant->id_major != NULL){
          $list_major = Major::where('id_faculty', Auth::user()->eptparticipant->major->id_faculty)->get();
        }
        else{
          $list_major = NULL;
        }

        $registEpt = Registerept::select("id")->where('id_eptparticipant', Auth::user()->eptparticipant->id)->pluck('id')->toArray();

        $highest = Score::select(['total_score'])->whereNotNull('total_score')->whereIn("id_registerept", $registEpt)->orderBy("total_score", "DESC")->first();

        $latest = DB::table("eptscore as score")
        ->select('total_score')
        ->leftjoin("registerept as reg", 'score.id_registerept', '=', 'reg.id')
        ->leftjoin("ept", 'reg.id_ept', '=', 'ept.id')
        ->whereIn("score.id_registerept", $registEpt)
        ->whereNotNull('total_score')
        ->orderBy('ept.ept_date', 'DESC')
        ->limit(2)
        ->pluck('total_score');

        if (count($latest) > 0) {
          if (empty($latest[1])) {
            $percentage = 0;
          }
          else{
            $percentage = round((($latest[0]-$latest[1])/$latest[1])*100,2);
          }

        }
        else{
          $percentage = 0;
        }
        $latest_score = DB::table("eptscore as score")
        ->select(['listening_score', 'structure_score', 'reading_score', 'total_score'])
        ->leftjoin("registerept as reg", 'score.id_registerept', '=', 'reg.id')
        ->leftjoin("ept", 'reg.id_ept', '=', 'ept.id')
        ->whereIn("score.id_registerept", $registEpt)
        ->whereNotNull('total_score')
        ->orderBy('ept.ept_date', 'DESC')
        ->limit(1)
        ->first();

        $failept1 = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->where('id_epttype', 1)
        ->where('total_score', '<', 450)
        ->count();

        $failept2 = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->where('id_epttype', 2)
        ->where('total_score', '<', 500)
        ->count();
        // dd($failept1);

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->orderBy('id_epttype', 'ASC')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isept.eptparticipant.index')->with([
      			'homepage'      => $homepage,
      			'mytest'        => $mytest,
            'eptverified'   => $eptverified,
            'registered'    => $registered,
            'page'          => $page,
            'graphic_1'     => json_encode($graphic_1, JSON_NUMERIC_CHECK),
            'graphic_2'     => json_encode($graphic_2, JSON_NUMERIC_CHECK),
            'list_major'    => $list_major,
            'eptest'        => $eptest,
            'gettimereg'    => $gettimereg,
            'getdatetest'   => $getdatetest,
            'gettimetest'   => $gettimetest,
            'highest'       => $highest,
            'percentage'    => $percentage,
            'latest_score'  => $latest_score,
            'failept1'      => $failept1,
            'failept2'      => $failept2,
        ]);
    }
}
