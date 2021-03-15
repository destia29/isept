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
use Auth;
use DB;


class MyeptscoreController extends Controller
{
  // DATE_FORMAT(ept.ept_date, '%M %e, %Y')
    public function index(){
        $graphic_1 = DB::select("
        SELECT * FROM(
          SELECT
            ept.ept_date as y,
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

		// $myeptscore = Score::with(['registerept'])->where('deleted_at', NULL)->get();
        $myeptscore = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->orderBy('attempt', 'DESC')
        ->get();

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

        // dd($myeptscore);
        // dd($adminuser);
        $page ='myeptscore';
        return view('isept.eptparticipant.myeptscore')->with([
			      'myeptscore'      => $myeptscore,
            'page'            => $page,
            'latest_score'    => $latest_score,
            'highest'       => $highest,
            'percentage'    => $percentage,
            'graphic_1'       => json_encode($graphic_1, JSON_NUMERIC_CHECK),
            'graphic_2'       => json_encode($graphic_2, JSON_NUMERIC_CHECK),
        ]);
    }
}
