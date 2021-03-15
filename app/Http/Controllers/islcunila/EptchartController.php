<?php

namespace App\Http\Controllers\islcunila;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Role;
use App\Model\Major;
use App\Model\Faculty;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Ept;
use App\Model\Type;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use DB;
class EptchartController extends Controller
{
    public function index(){

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 1
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");
        $ept_s2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");
        // DATE_FORMAT(ept.ept_date, '%M %d, %Y')

        $daily_pass = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 450
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 10
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $monthly_registered = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(reg.id) FROM registerept as reg
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptscore as es ON es.id_registerept = reg.id
              WHERE es.total_score IS NOT NULL
              AND reg.status NOT IN('Unverified', 'Abandoned')
              AND ept_1.ept_date = ept.ept_date
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 30
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $daily_passs2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 500
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 10
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $monthly_registereds2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(reg.id) FROM registerept as reg
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptscore as es ON es.id_registerept = reg.id
              WHERE es.total_score IS NOT NULL
              AND reg.status NOT IN('Unverified', 'Abandoned')
              AND ept_1.ept_date = ept.ept_date
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 30
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $sum_latest_pass = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 450
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        $sum_latest_part = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM registerept as reg
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND reg.status NOT IN('Abandoned','Unverified')
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");



        $eptchart = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='eptchart';
        return view('isclunila.eptchart')->with([
      			'eptchart'          => $eptchart,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'            => json_encode($ept_s2, JSON_NUMERIC_CHECK),
      			]);
    }

    public function filterdata(Request $req){
        $searchdate = "";
        $searchdate_end = "";
        if ($req->ept_date_start != "") {
          $searchdate = date('Y-m-d', strtotime($req->ept_date_start));
        }
        if ($req->ept_date_end != "") {
          $searchdate_end = date('Y-m-d', strtotime($req->ept_date_end));
        }

        $searchscore = "";
        if ($req->ept_score != "") {
          $searchscore = $req->ept_score;
        }

        $searchdate_data = "";
        if (($searchdate != null || $searchdate != "") && ($searchdate_end != null || $searchdate_end != "")) {
          $searchdate_data = " AND (es.created_at BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
          // dd($searchdate);
        }

        $searchscore_data = "";
        if ($searchscore != "") {
          if ($searchscore == 1) {
            $searchscore_data = " AND (es.total_score <= 677 AND es.total_score > 600) ";
          } elseif ($searchscore == 2) {
            $searchscore_data = " AND (es.total_score <= 600 AND es.total_score > 500) ";
          } elseif ($searchscore == 3) {
            $searchscore_data = " AND (es.total_score <= 500 AND es.total_score > 450) ";
          } elseif ($searchscore == 4) {
            $searchscore_data = " AND (es.total_score <= 450 AND es.total_score > 400) ";
          } elseif ($searchscore == 5) {
            $searchscore_data = " AND es.total_score <= 400 ";
          }
        }
        dd($searchscore_data);

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 1
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");
        $ept_s2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");
        // DATE_FORMAT(ept.ept_date, '%M %d, %Y')

        $daily_pass = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 450
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 10
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $monthly_registered = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(reg.id) FROM registerept as reg
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptscore as es ON es.id_registerept = reg.id
              WHERE es.total_score IS NOT NULL
              AND reg.status NOT IN('Unverified', 'Abandoned')
              AND ept_1.ept_date = ept.ept_date
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 30
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $daily_passs2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 500
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 10
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $monthly_registereds2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(reg.id) FROM registerept as reg
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptscore as es ON es.id_registerept = reg.id
              WHERE es.total_score IS NOT NULL
              AND reg.status NOT IN('Unverified', 'Abandoned')
              AND ept_1.ept_date = ept.ept_date
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 30
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $sum_latest_pass = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 450
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        $sum_latest_part = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM registerept as reg
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND reg.status NOT IN('Abandoned','Unverified')
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");



        $eptchart = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='eptchart';
        return view('isclunila.eptchart')->with([
            'eptchart'          => $eptchart,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'            => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            ]);
    }
}
