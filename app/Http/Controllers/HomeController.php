<?php

namespace App\Http\Controllers;

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
class HomeController extends Controller
{
    public function homepageadminlcunila(){

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

        $ept_s2 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s2 ORDER BY ept_s2.y ASC
        ");

        $last_ept_part_s1 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 1)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $month_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $year_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $last_ept_part_s2 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 2)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

        $month_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as hasil
        ");

        $year_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

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
        ) as ept_s2 ORDER BY ept_s2.ept_date ASC
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

        if (count($sum_latest_part) > 0) {
          if ($sum_latest_part[0]->jumlah == 0) {
            $latest_pass_percentage = 0;
          }
          else{
            if ($sum_latest_pass[0]->jumlah == 0) {
              $latest_pass_percentage = 0;
            }
            else{
              $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage = 0;
        }

        $sum_latest_pass_s2 = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
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
          LIMIT 1
        ");

        $sum_latest_part_s2 = DB::select("
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
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        if (count($sum_latest_part_s2) > 0) {
          if ($sum_latest_part_s2[0]->jumlah == 0) {
            $latest_pass_percentage_s2 = 0;
          }
          else{
            if ($sum_latest_pass_s2[0]->jumlah == 0) {
              $latest_pass_percentage_s2 = 0;
            }
            else{
              $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage_s2 = 0;
        }

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isclunila.adminclu.index')->with([
      			'homepage'         => $homepage,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'            => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'daily_pass'            => array_column($daily_pass, 'jumlah'),
            'monthly_registered'    => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'          => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'  => array_column($monthly_registereds2, 'jumlah'),
      			'last_ept_part_s1'  => $last_ept_part_s1,
      			'week_ept_part_s1'  => $week_ept_part_s1,
      			'month_ept_part_s1' => $month_ept_part_s1,
      			'year_ept_part_s1'  => $year_ept_part_s1,
      			'last_ept_part_s2'  => $last_ept_part_s2,
      			'week_ept_part_s2'  => $week_ept_part_s2,
      			'month_ept_part_s2' => $month_ept_part_s2,
      			'year_ept_part_s2'  => $year_ept_part_s2,
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part_s2) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
        ]);
    }

    public function homepageadminept(){

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
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
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s2 ORDER BY ept_s2.y ASC
        ");

        $last_ept_part_s1 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 1)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $month_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $year_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $last_ept_part_s2 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 2)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

        $month_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as hasil
        ");

        $year_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

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


        if (count($sum_latest_part) > 0) {
          if ($sum_latest_part[0]->jumlah == 0) {
            $latest_pass_percentage = 0;
          }
          else{
            if ($sum_latest_pass[0]->jumlah == 0) {
              $latest_pass_percentage = 0;
            }
            else{
              $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage = 0;
        }

        $sum_latest_pass_s2 = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
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
          LIMIT 1
        ");

        $sum_latest_part_s2 = DB::select("
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
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        if (count($sum_latest_part_s2) > 0) {
          if ($sum_latest_part_s2[0]->jumlah == 0) {
            $latest_pass_percentage_s2 = 0;
          }
          else{
            if ($sum_latest_pass_s2[0]->jumlah == 0) {
              $latest_pass_percentage_s2 = 0;
            }
            else{
              $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage_s2 = 0;
        }

        // QUERY AS atau alias bisa tidak ditulis, contoh: eptscore es

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isept.adminept.index')->with([
      			'homepage'              => $homepage,
            'daily_pass'            => array_column($daily_pass, 'jumlah'),
            'monthly_registered'    => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'          => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'  => array_column($monthly_registereds2, 'jumlah'),
            'eptverified'           => $eptverified,
            'registered'            => $registered,
            'page'                  => $page,
            'ept_s1'                => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'                => json_encode($ept_s2, JSON_NUMERIC_CHECK),
      			'last_ept_part_s1'      => $last_ept_part_s1,
      			'week_ept_part_s1'      => $week_ept_part_s1,
      			'month_ept_part_s1'     => $month_ept_part_s1,
      			'year_ept_part_s1'      => $year_ept_part_s1,
      			'last_ept_part_s2'      => $last_ept_part_s2,
      			'week_ept_part_s2'      => $week_ept_part_s2,
      			'month_ept_part_s2'     => $month_ept_part_s2,
      			'year_ept_part_s2'      => $year_ept_part_s2,
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part_s2) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
        ]);
    }

    public function homepageeptvaluemanager(){

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
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
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s2 ORDER BY ept_s2.y ASC
        ");

        $last_ept_part_s1 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 1)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $month_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $year_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $last_ept_part_s2 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 2)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

        $month_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as hasil
        ");

        $year_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

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
        // dd($daily_passs2);
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

        if (count($sum_latest_part) > 0) {
          if ($sum_latest_part[0]->jumlah == 0) {
            $latest_pass_percentage = 0;
          }
          else{
            if ($sum_latest_pass[0]->jumlah == 0) {
              $latest_pass_percentage = 0;
            }
            else{
              $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage = 0;
        }

        // dd($sum_latest_part[0]->jumlah);

        $sum_latest_pass_s2 = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
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
          LIMIT 1
        ");

        $sum_latest_part_s2 = DB::select("
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
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        if (count($sum_latest_part_s2) > 0) {
          if ($sum_latest_part_s2[0]->jumlah == 0) {
            $latest_pass_percentage_s2 = 0;
          }
          else{
            if ($sum_latest_pass_s2[0]->jumlah == 0) {
              $latest_pass_percentage_s2 = 0;
            }
            else{
              $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage_s2 = 0;
        }


        $mytest = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('epttype', 'id_epttype', '=', 'epttype.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->orderBy('attempt', 'DESC')
        ->get();

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isept.eptvaluemanager.index')->with([
      			'homepage'        => $homepage,
      			'mytest'          => $mytest,
            'eptverified'     => $eptverified,
            'registered'      => $registered,
            'page'            => $page,
            'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'daily_pass'            => array_column($daily_pass, 'jumlah'),
            'monthly_registered'    => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'          => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'  => array_column($monthly_registereds2, 'jumlah'),
      			'last_ept_part_s1'  => $last_ept_part_s1,
      			'week_ept_part_s1'  => $week_ept_part_s1,
      			'month_ept_part_s1' => $month_ept_part_s1,
      			'year_ept_part_s1'  => $year_ept_part_s1,
      			'last_ept_part_s2'  => $last_ept_part_s2,
      			'week_ept_part_s2'  => $week_ept_part_s2,
      			'month_ept_part_s2' => $month_ept_part_s2,
      			'year_ept_part_s2'  => $year_ept_part_s2,
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part_s2) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
        ]);
    }

    public function homepageadmindekanat(){

        $alias = explode(' ', Auth::user()->adminuser->position);
        // dd($alias);
        $getAlias = $alias[2];

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN users as user ON eptpart.id_user = user.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              AND faculty.faculty_alias = '".$getAlias."'
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN users as user ON eptpart.id_user = user.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              AND faculty.faculty_alias = '".$getAlias."'
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN users as user ON eptpart.id_user = user.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              WHERE ept_1.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              AND faculty.faculty_alias = '".$getAlias."'
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
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN users as user ON eptpart.id_user = user.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              WHERE ept_2.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              AND faculty.faculty_alias = '".$getAlias."'
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN users as user ON eptpart.id_user = user.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              WHERE ept_2.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              AND faculty.faculty_alias = '".$getAlias."'
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN users as user ON eptpart.id_user = user.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              WHERE ept_2.ept_date = ept.ept_date
              AND total_score IS NOT NULL
              AND faculty.faculty_alias = '".$getAlias."'
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s2 ORDER BY ept_s2.y ASC
        ");

        $last_ept_part_s1 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah"
        ))
        ->where("id_epttype", 1)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");
        // dd($week_ept_part_s1);
        $month_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $year_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $last_ept_part_s2 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah"
        ))
        ->where("id_epttype", 2)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

        $month_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as hasil
        ");

        $year_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major ON eptpart.id_major = major.id
            LEFT JOIN faculty ON major.id_faculty = faculty.id
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
            AND faculty.faculty_alias = '".$getAlias."'
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

        $daily_pass = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 450
              AND faculty.faculty_alias = '".$getAlias."'
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

        $sum_latest_pass = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 450
              AND faculty.faculty_alias = '".$getAlias."'
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
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND faculty.faculty_alias = '".$getAlias."'
              AND reg.status NOT IN('Abandoned','Unverified')
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 1
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        if (count($sum_latest_part) > 0) {
          if ($sum_latest_part[0]->jumlah == 0) {
            $latest_pass_percentage = 0;
          }
          else{
            if ($sum_latest_pass[0]->jumlah == 0) {
              $latest_pass_percentage = 0;
            }
            else{
              $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage = 0;
        }

        $sum_latest_pass_s2 = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 500
              AND faculty.faculty_alias = '".$getAlias."'
              ORDER BY total_score DESC
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        $sum_latest_part_s2 = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM registerept as reg
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND faculty.faculty_alias = '".$getAlias."'
              AND reg.status NOT IN('Abandoned','Unverified')
              limit 1
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        if (count($sum_latest_part_s2) > 0) {
          if ($sum_latest_part_s2[0]->jumlah == 0) {
            $latest_pass_percentage_s2 = 0;
          }
          else{
            if ($sum_latest_pass_s2[0]->jumlah == 0) {
              $latest_pass_percentage_s2 = 0;
            }
            else{
              $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage_s2 = 0;
        }

        $monthly_registered = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(reg.id) FROM registerept as reg
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptscore as es ON es.id_registerept = reg.id
              WHERE es.total_score IS NOT NULL
              AND reg.status NOT IN('Unverified', 'Abandoned')
              AND ept_1.ept_date = ept.ept_date
              AND faculty.faculty_alias = '".$getAlias."'
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
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              AND es.total_score >= 500
              AND faculty.faculty_alias = '".$getAlias."'
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
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major ON eptpart.id_major = major.id
              LEFT JOIN faculty ON major.id_faculty = faculty.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              LEFT JOIN eptscore as es ON es.id_registerept = reg.id
              WHERE es.total_score IS NOT NULL
              AND reg.status NOT IN('Unverified', 'Abandoned')
              AND ept_1.ept_date = ept.ept_date
              AND faculty.faculty_alias = '".$getAlias."'
            ) as jumlah
          FROM ept
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 30
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
        ");

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isept.admindekanat.index')->with([
      			'homepage'        => $homepage,
            'eptverified'     => $eptverified,
            'registered'      => $registered,
            'page'            => $page,
            'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'daily_pass'            => array_column($daily_pass, 'jumlah'),
            'monthly_registered'    => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'          => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'  => array_column($monthly_registereds2, 'jumlah'),
      			'last_ept_part_s1'  => $last_ept_part_s1,
      			'week_ept_part_s1'  => $week_ept_part_s1,
      			'month_ept_part_s1' => $month_ept_part_s1,
      			'year_ept_part_s1'  => $year_ept_part_s1,
      			'last_ept_part_s2'  => $last_ept_part_s2,
      			'week_ept_part_s2'  => $week_ept_part_s2,
      			'month_ept_part_s2' => $month_ept_part_s2,
      			'year_ept_part_s2'  => $year_ept_part_s2,
            'getAlias'          => $getAlias,
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part_s2) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
        ]);
    }

    public function homepagechiefoftheboard(){

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          ept.ept_date as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
              WHERE ept_1.ept_date = ept.ept_date
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
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept_2 ON reg.id_ept = ept_2.id
              WHERE ept_2.ept_date = ept.ept_date
              limit 1
            ) as c
          FROM ept
          WHERE id_epttype = 2
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s2 ORDER BY ept_s2.y ASC
        ");

        $last_ept_part_s1 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 1)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $month_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $year_ept_part_s1 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 1
        ) as jumlah
        ");

        $last_ept_part_s2 = DB::table('ept')
        ->select(DB::raw(
          "ept.id as id,
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.id_ept = ept.id
          ) as jumlah"
        ))
        ->where("id_epttype", 2)
        ->orderBy("ept_date", "DESC")
        ->first();

        $week_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfWeek()."' AND '".Carbon::now()->endOfWeek()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

        $month_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfMonth()."' AND '".Carbon::now()->endOfMonth()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as hasil
        ");

        $year_ept_part_s2 = DB::select("
        SELECT SUM(jumlah) as jumlah FROM(
          SELECT
          (
            SELECT count(reg.id) FROM registerept as reg
            WHERE reg.status NOT IN('Abandoned','Unverified')
            AND reg.created_at BETWEEN '".Carbon::now()->startOfYear()."' AND '".Carbon::now()->endOfYear()."'
            AND reg.id_ept = ept.id
          ) as jumlah
          FROM ept
          WHERE id_epttype = 2
        ) as jumlah
        ");

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

        if (count($sum_latest_part) > 0) {
          if ($sum_latest_part[0]->jumlah == 0) {
            $latest_pass_percentage = 0;
          }
          else{
            if ($sum_latest_pass[0]->jumlah == 0) {
              $latest_pass_percentage = 0;
            }
            else{
              $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage = 0;
        }

        $sum_latest_pass_s2 = DB::select("
          SELECT
          ept.ept_date as ept_date,
          (
              SELECT COUNT(*) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
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
          LIMIT 1
        ");

        $sum_latest_part_s2 = DB::select("
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
          WHERE id_epttype = 2
          GROUP BY ept.ept_date
          ORDER BY ept.ept_date DESC
          LIMIT 1
        ");

        if (count($sum_latest_part_s2) > 0) {
          if ($sum_latest_part_s2[0]->jumlah == 0) {
            $latest_pass_percentage_s2 = 0;
          }
          else{
            if ($sum_latest_pass_s2[0]->jumlah == 0) {
              $latest_pass_percentage_s2 = 0;
            }
            else{
              $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
            }
          }
        } else {
          $latest_pass_percentage_s2 = 0;
        }


        $mytest = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('epttype', 'id_epttype', '=', 'epttype.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->orderBy('attempt', 'DESC')
        ->get();

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='index';
        return view('isclunila.chiefoftheboard.index')->with([
      			'homepage'        => $homepage,
      			'mytest'          => $mytest,
            'eptverified'     => $eptverified,
            'registered'      => $registered,
            'page'            => $page,
            'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'daily_pass'            => array_column($daily_pass, 'jumlah'),
            'monthly_registered'    => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'          => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'  => array_column($monthly_registereds2, 'jumlah'),
      			'last_ept_part_s1'  => $last_ept_part_s1,
      			'week_ept_part_s1'  => $week_ept_part_s1,
      			'month_ept_part_s1' => $month_ept_part_s1,
      			'year_ept_part_s1'  => $year_ept_part_s1,
      			'last_ept_part_s2'  => $last_ept_part_s2,
      			'week_ept_part_s2'  => $week_ept_part_s2,
      			'month_ept_part_s2' => $month_ept_part_s2,
      			'year_ept_part_s2'  => $year_ept_part_s2,
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part_s2) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,

        ]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id_role == 1) {
            return redirect()->route('admingod.index');
        }
        elseif (Auth::user()->id_role == 2) {
            return redirect()->route('adminlcunila.index');
        }
        elseif (Auth::user()->id_role == 3) {
            return redirect()->route('adminept.index');
        }
        elseif (Auth::user()->id_role == 4) {
            return redirect()->route('eptvaluemanager.index');
        }
        elseif (Auth::user()->id_role == 5) {
            return redirect()->route('admindekanat.index');
        }
        elseif (Auth::user()->id_role == 6) {
            return redirect()->route('chiefoftheboard.index');
        }
        elseif (Auth::user()->id_role == 7) {
            return redirect()->route('eptparticipant.index');
        }
    }
}
