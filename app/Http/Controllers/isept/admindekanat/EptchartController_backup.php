<?php

namespace App\Http\Controllers\isept\admindekanat;

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
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isept.admindekanat.eptchart')->with([
      			'eptchart'          => $eptchart,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
      			]);
    }


}
