<?php

namespace App\Http\Controllers\isept\eptvaluemanager;

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
use PDFBarry;
class EptfacultyController extends Controller
{
    public function index(Request $req){
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
        $searchdate_data_y = "";
        if (($searchdate != null || $searchdate != "") && ($searchdate_end != null || $searchdate_end != "")) {
          $searchdate_data = " AND (es.created_at BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
          $searchdate_data_y = " AND (ept.ept_date BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
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
          } elseif ($searchscore == 6) {
            $searchscore_data = "";
          }
        }

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          faculty.faculty_alias as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM faculty as faculty LEFT JOIN major as maj ON maj.id_faculty = faculty.id
          LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = maj.id
          LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
          LEFT JOIN ept as ept ON reg.id_ept = ept.id
          WHERE faculty.id != 9 AND
           ept.id_epttype = 1
           ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 8
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");

        $ept_s2 = DB::select("
        SELECT * FROM(
          SELECT
          faculty.faculty_alias as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
              ".$searchdate_data.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM faculty as faculty LEFT JOIN major as maj ON maj.id_faculty = faculty.id
          LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = maj.id
          LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
          LEFT JOIN ept as ept ON reg.id_ept = ept.id
          WHERE faculty.id != 9 AND
           ept.id_epttype = 2
           ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 8
        ) as ept_s2 ORDER BY ept_s2.y ASC
        ");
        // DATE_FORMAT(ept.ept_date, '%M %d, %Y')

        // PERCENTAGE BEGIN
                $daily_pass = DB::select("
                  SELECT * FROM(
                    SELECT
                    ept.ept_date as ept_date,
                    (
                        SELECT COUNT(*) FROM eptscore as es
                        LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                        LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                        WHERE ept_1.ept_date = ept.ept_date
                        ".$searchdate_data_y.$searchscore_data."
                        ORDER BY total_score DESC
                        limit 1
                      ) as jumlah
                    FROM ept
                    WHERE id_epttype = 1
                    ".$searchdate_data_y."
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
                        ".$searchdate_data_y.$searchscore_data."
                        ORDER BY total_score DESC
                        limit 1
                      ) as jumlah
                    FROM ept
                    WHERE id_epttype = 2
                    ".$searchdate_data_y."
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
                  ) as ept_s2 ORDER BY ept_s2.ept_date ASC
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
                    ".$searchdate_data_y.$searchscore_data."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    ORDER BY total_score DESC
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 1
                ".$searchdate_data_y."
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
                    ".$searchdate_data_y."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 1
                ".$searchdate_data_y."
                GROUP BY ept.ept_date
                ORDER BY ept.ept_date DESC
                LIMIT 1
              ");

                if (count($sum_latest_part) > 0) {
                    if ($sum_latest_pass[0]->jumlah == 0) {
                      $latest_pass_percentage= 0;
                    }
                    else{
                      $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
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
                    ".$searchdate_data_y.$searchscore_data."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    ORDER BY total_score DESC
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 2
                ".$searchdate_data_y."
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
                    ".$searchdate_data_y."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 2
                ".$searchdate_data_y."
                GROUP BY ept.ept_date
                ORDER BY ept.ept_date DESC
                LIMIT 1
              ");

                if (count($sum_latest_part_s2) > 0) {
                    if ($sum_latest_pass_s2[0]->jumlah == 0) {
                      $latest_pass_percentage_s2 = 0;
                    }
                    else{
                      $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
                    }
                } else {
                  $latest_pass_percentage_s2 = 0;
                }

        // PERCENTAGE ENDED



        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='eptfaculty';
        return view('isept.eptvaluemanager.eptfaculty')->with([
      			'homepage'         => $homepage,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'daily_pass'              => array_column($daily_pass, 'jumlah'),
            'monthly_registered'      => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'            => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'    => array_column($monthly_registereds2, 'jumlah'),
            'ept_s1'                  => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'                  => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
            ]);
    }

    public function filter(Request $req){

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
        $searchdate_data_y = "";
        if (($searchdate != null || $searchdate != "") && ($searchdate_end != null || $searchdate_end != "")) {
          $searchdate_data = " AND (es.created_at BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
          $searchdate_data_y = " AND (ept.ept_date BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
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
          } elseif ($searchscore == 6) {
            $searchscore_data = "";
          }
        }

        $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          faculty.faculty_alias as y,
          (
            SELECT MAX(total_score) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            AND ept.ept_date = ept.ept_date
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
              ".$searchdate_data_y.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
              ".$searchdate_data_y.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM faculty as faculty LEFT JOIN major as maj ON maj.id_faculty = faculty.id
          LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = maj.id
          LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
          LEFT JOIN ept as ept ON reg.id_ept = ept.id
          WHERE faculty.id != 9 AND
           ept.id_epttype = 1
          ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 8
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");

        $ept_s2 = DB::select("
        SELECT * FROM(
          SELECT
          faculty.faculty_alias as y,
          (
              SELECT MAX(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
              ".$searchdate_data_y.$searchscore_data."
              AND total_score IS NOT NULL
              ORDER BY total_score DESC
              limit 1
            ) as a,
          (
              SELECT FLOOR(AVG(total_score)) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
              ".$searchdate_data_y.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as b,
          (
              SELECT MIN(total_score) FROM eptscore as es
              LEFT JOIN registerept as reg ON es.id_registerept = reg.id
              LEFT JOIN ept as ept ON reg.id_ept = ept.id
              LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
              LEFT JOIN major as maj ON eptpart.id_major = maj.id
              LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
              WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
              ".$searchdate_data_y.$searchscore_data."
              AND total_score IS NOT NULL
              limit 1
            ) as c
          FROM faculty as faculty LEFT JOIN major as maj ON maj.id_faculty = faculty.id
          LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = maj.id
          LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
          LEFT JOIN ept as ept ON reg.id_ept = ept.id
          WHERE faculty.id != 9 AND
          ept.id_epttype = 2
          ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 8
        ) as ept_s1 ORDER BY ept_s1.y ASC
        ");
        // DATE_FORMAT(ept.ept_date, '%M %d, %Y')

        // PERCENTAGE BEGIN
                $daily_pass = DB::select("
                  SELECT * FROM(
                    SELECT
                    ept.ept_date as ept_date,
                    (
                        SELECT COUNT(*) FROM eptscore as es
                        LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                        LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                        WHERE ept_1.ept_date = ept.ept_date
                        ".$searchdate_data_y.$searchscore_data."
                        ORDER BY total_score DESC
                        limit 1
                      ) as jumlah
                    FROM ept
                    WHERE id_epttype = 1
                    ".$searchdate_data_y."
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
                        ".$searchdate_data_y.$searchscore_data."
                        ORDER BY total_score DESC
                        limit 1
                      ) as jumlah
                    FROM ept
                    WHERE id_epttype = 2
                    ".$searchdate_data_y."
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
                  ) as ept_s2 ORDER BY ept_s2.ept_date ASC
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
                    ".$searchdate_data_y.$searchscore_data."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    ORDER BY total_score DESC
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 1
                ".$searchdate_data_y."
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
                    ".$searchdate_data_y."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 1
                ".$searchdate_data_y."
                GROUP BY ept.ept_date
                ORDER BY ept.ept_date DESC
                LIMIT 1
              ");

                if (count($sum_latest_part) > 0) {
                    if ($sum_latest_pass[0]->jumlah == 0) {
                      $latest_pass_percentage= 0;
                    }
                    else{
                      $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
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
                    ".$searchdate_data_y.$searchscore_data."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    ORDER BY total_score DESC
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 2
                ".$searchdate_data_y."
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
                    ".$searchdate_data_y."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 2
                ".$searchdate_data_y."
                GROUP BY ept.ept_date
                ORDER BY ept.ept_date DESC
                LIMIT 1
              ");

                if (count($sum_latest_part_s2) > 0) {
                    if ($sum_latest_pass_s2[0]->jumlah == 0) {
                      $latest_pass_percentage_s2 = 0;
                    }
                    else{
                      $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
                    }
                } else {
                  $latest_pass_percentage_s2 = 0;
                }

        // PERCENTAGE ENDED

        $searchdate_data = "";
        if ($searchdate != "" && $searchdate_end) {
          $ubah = date('d-m-Y', strtotime($searchdate));
          $ubah1 = date('d-m-Y', strtotime($searchdate_end));
          $searchdate_data = $ubah." s/d ".$ubah1;
        }
        $searchscore_data = "";
        if ($searchscore == 1) {
          $searchscore_data = "677 >= x > 600";
        } elseif ($searchscore == 2) {
          $searchscore_data = "600 >= x > 500";
        } elseif ($searchscore == 3) {
          $searchscore_data = "500 >= x > 450";
        } elseif ($searchscore == 4) {
          $searchscore_data = "450 >= x > 400";
        } elseif ($searchscore == 5) {
          $searchscore_data = "x <= 400";
        } elseif ($searchscore == 6) {
          $searchscore_data = "All Score";
        }
        $ket = array(
          "date"        => $searchdate_data,
          "searchscore" => $searchscore_data
        );

        $raw_filter = array(
          "date_start"        => $req->ept_date_start,
          "date_end"          => $req->ept_date_end,
          "searchscore_data"  => $req->ept_score
        );

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='eptfaculty';
        return view('isept.eptvaluemanager.eptfaculty')->with([
            'homepage'         => $homepage,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'daily_pass'              => array_column($daily_pass, 'jumlah'),
            'monthly_registered'      => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'            => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'    => array_column($monthly_registereds2, 'jumlah'),
            'ept_s1'                  => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'                  => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
            'ket'             => $ket,
            'raw_filter'      => $raw_filter
        ]);
    }

    public function pdf(Request $req){

      if (($req->ept_date_start == "" && $req->ept_date_end == "") || $req->ept_score == "") {
        return redirect()->route('eptvaluemanager.eptfaculty')->with('error', 'Date Range, dan Range Skor wajib diisi');
      }

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
      $searchdate_data_y = "";
      if (($searchdate != null || $searchdate != "") && ($searchdate_end != null || $searchdate_end != "")) {
        $searchdate_data = " AND (es.created_at BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
        $searchdate_data_y = " AND (ept.ept_date BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
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
        } elseif ($searchscore == 6) {
          $searchscore_data = "";
        }
      }

      $ept_s1 = DB::select("
        SELECT * FROM(
          SELECT
          faculty.faculty_alias as y,
          (
            SELECT MAX(total_score) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as a,
          (
            SELECT username FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN users as user ON eptpart.id_user = user.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = a
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as a_id,
          (
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = a
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
            ) as d_id,
          (
            SELECT ept_date FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y."
            AND  total_score = a
            ORDER BY total_score DESC
            limit 1
            ) as tanggal,
          (
            SELECT FLOOR(AVG(total_score)) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            limit 1
          ) as b,
          (
            SELECT MIN(total_score) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            limit 1
          ) as c,
          (
            SELECT username FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN users as user ON eptpart.id_user = user.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = c
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as c_id,
          (
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = c
            ORDER BY total_score DESC
            limit 1
          ) as e_id,
          (
            SELECT ept_date FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 1
            ".$searchdate_data_y."
            AND  total_score = c
            ORDER BY total_score DESC
            limit 1
            ) as tanggal2,
          ept.ept_date
          FROM faculty as faculty LEFT JOIN major as maj ON maj.id_faculty = faculty.id
          LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = maj.id
          LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
          LEFT JOIN ept as ept ON reg.id_ept = ept.id
          WHERE faculty.id != 9 AND
          ept.id_epttype = 1
          ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 8
        ) as ept_s1 ORDER BY ept_s1.ept_date ASC
      ");

      $ept_s2 = DB::select("
        SELECT * FROM(
          SELECT
          faculty.faculty_alias as y,
          (
            SELECT MAX(total_score) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as a,
          (
            SELECT username FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN users as user ON eptpart.id_user = user.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            AND ept.ept_date = ept.ept_date
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = a
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as a_id,
          (
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            AND ept.ept_date = ept.ept_date
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = a
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as d_id,
          (
            SELECT ept_date FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            ".$searchdate_data_y."
            AND  total_score = a
            ORDER BY total_score DESC
            limit 1
          ) as tanggal,
          (
            SELECT FLOOR(AVG(total_score)) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            limit 1
          ) as b,
          (
            SELECT MIN(total_score) FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            ".$searchdate_data_y.$searchscore_data."
            AND total_score IS NOT NULL
            limit 1
          ) as c,
          (
            SELECT username FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN users as user ON eptpart.id_user = user.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            AND ept.ept_date = ept.ept_date
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = c
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as c_id,
          (
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            AND ept.ept_date = ept.ept_date
            ".$searchdate_data_y.$searchscore_data."
            AND total_score = c
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as e_id,
          (
            SELECT ept_date FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept ON reg.id_ept = ept.id
            LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
            LEFT JOIN major as maj ON eptpart.id_major = maj.id
            LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
            WHERE fac.faculty_name = faculty.faculty_name AND ept.id_epttype = 2
            ".$searchdate_data_y."
            AND  total_score = c
            ORDER BY total_score DESC
            limit 1
          ) as tanggal2,
          ept.ept_date
          FROM faculty as faculty LEFT JOIN major as maj ON maj.id_faculty = faculty.id
          LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = maj.id
          LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
          LEFT JOIN ept as ept ON reg.id_ept = ept.id
          WHERE faculty.id != 9 AND
          ept.id_epttype = 2
          ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 8
        ) as ept_s2 ORDER BY ept_s2.ept_date ASC
      ");

      // PERCENTAGE BEGIN
              $daily_pass = DB::select("
                SELECT * FROM(
                  SELECT
                  ept.ept_date as ept_date,
                  (
                      SELECT COUNT(*) FROM eptscore as es
                      LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                      LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                      WHERE ept_1.ept_date = ept.ept_date
                      ".$searchdate_data_y.$searchscore_data."
                      ORDER BY total_score DESC
                      limit 1
                    ) as jumlah
                  FROM ept
                  WHERE id_epttype = 1
                  ".$searchdate_data_y."
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
                      ".$searchdate_data_y.$searchscore_data."
                      ORDER BY total_score DESC
                      limit 1
                    ) as jumlah
                  FROM ept
                  WHERE id_epttype = 2
                  ".$searchdate_data_y."
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
                ) as ept_s2 ORDER BY ept_s2.ept_date ASC
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
                  ".$searchdate_data_y.$searchscore_data."
                  AND reg.status NOT IN('Abandoned','Unverified')
                  ORDER BY total_score DESC
                  limit 1
                ) as jumlah
              FROM ept
              WHERE id_epttype = 1
              ".$searchdate_data_y."
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
                  ".$searchdate_data_y."
                  AND reg.status NOT IN('Abandoned','Unverified')
                  limit 1
                ) as jumlah
              FROM ept
              WHERE id_epttype = 1
              ".$searchdate_data_y."
              GROUP BY ept.ept_date
              ORDER BY ept.ept_date DESC
              LIMIT 1
            ");

              if (count($sum_latest_part) > 0) {
                  if ($sum_latest_pass[0]->jumlah == 0) {
                    $latest_pass_percentage= 0;
                  }
                  else{
                    $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
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
                  ".$searchdate_data_y.$searchscore_data."
                  AND reg.status NOT IN('Abandoned','Unverified')
                  ORDER BY total_score DESC
                  limit 1
                ) as jumlah
              FROM ept
              WHERE id_epttype = 2
              ".$searchdate_data_y."
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
                  ".$searchdate_data_y."
                  AND reg.status NOT IN('Abandoned','Unverified')
                  limit 1
                ) as jumlah
              FROM ept
              WHERE id_epttype = 2
              ".$searchdate_data_y."
              GROUP BY ept.ept_date
              ORDER BY ept.ept_date DESC
              LIMIT 1
            ");

              if (count($sum_latest_part_s2) > 0) {
                  if ($sum_latest_pass_s2[0]->jumlah == 0) {
                    $latest_pass_percentage_s2 = 0;
                  }
                  else{
                    $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
                  }
              } else {
                $latest_pass_percentage_s2 = 0;
              }

      // PERCENTAGE ENDED

      $searchdate_data = "";
      if ($searchdate != "" && $searchdate_end) {
        $ubah = date('d-m-Y', strtotime($searchdate));
        $ubah1 = date('d-m-Y', strtotime($searchdate_end));
        $searchdate_data = $ubah." s/d ".$ubah1;
      }
      $searchscore_data = "";
      if ($searchscore == 1) {
        $searchscore_data = "677 >= x > 600";
      } elseif ($searchscore == 2) {
        $searchscore_data = "600 >= x > 500";
      } elseif ($searchscore == 3) {
        $searchscore_data = "500 >= x > 450";
      } elseif ($searchscore == 4) {
        $searchscore_data = "450 >= x > 400";
      } elseif ($searchscore == 5) {
        $searchscore_data = "x <= 400";
      } elseif ($searchscore == 6) {
        $searchscore_data = "All Score";
      }
      $ket = array(
        "date"    => $searchdate_data,
        "searchscore" => $searchscore_data
      );

      // return view("isept.eptvaluemanager.pdffaculty")->with([
      //   'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
      //   'ept_s1_raw'      => $ept_s1,
      //   'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
      //   'ept_s2_raw'      => $ept_s2,
      //   'ket'             => $ket,
      // ]);
      $pdf = PDFBarry::loadView("isept.eptvaluemanager.pdffaculty", [
        'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
        'ept_s1_raw'      => $ept_s1,
        'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
        'ept_s2_raw'      => $ept_s2,
        'ket'             => $ket,
      ]);
      $pdf->setOption('enable-javascript', true);
      // $pdf->setOption('javascript-delay', 5000);
      $pdf->setOption('enable-smart-shrinking', true);
      $pdf->setOption('no-stop-slow-scripts', true);
      $fileName = "EPT FACULTY ".date("Y-m-d");
      return $pdf->stream($fileName);
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
        $searchdate_data_y = "";
        if (($searchdate != null || $searchdate != "") && ($searchdate_end != null || $searchdate_end != "")) {
          $searchdate_data = " AND (es.created_at BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
          $searchdate_data_y = " AND (ept.ept_date BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
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
          } elseif ($searchscore == 6) {
            $searchscore_data = "";
          }
        }
        // dd($searchscore_data);

        $ept_s1 = DB::select("
          SELECT * FROM(
            SELECT
            ept.ept_date as y,
            (
                SELECT MAX(total_score) FROM eptscore as es
                LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                WHERE ept_1.ept_date = ept.ept_date
                ".$searchdate_data_y.$searchscore_data."
                AND total_score IS NOT NULL
                ORDER BY total_score DESC
                limit 1
              ) as a,
            (
                SELECT FLOOR(AVG(total_score)) FROM eptscore as es
                LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                WHERE ept_1.ept_date = ept.ept_date
                ".$searchdate_data_y.$searchscore_data."
                AND total_score IS NOT NULL
                limit 1
              ) as b,
            (
                SELECT MIN(total_score) FROM eptscore as es
                LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                WHERE ept_1.ept_date = ept.ept_date
                ".$searchdate_data_y.$searchscore_data."
                AND total_score IS NOT NULL
                limit 1
              ) as c
            FROM ept
            WHERE id_epttype = 1
            ".$searchdate_data_y."
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
                ".$searchdate_data_y.$searchscore_data."
                AND total_score IS NOT NULL
                ORDER BY total_score DESC
                limit 1
              ) as a,
            (
                SELECT FLOOR(AVG(total_score)) FROM eptscore as es
                LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                WHERE ept_1.ept_date = ept.ept_date
                ".$searchdate_data_y.$searchscore_data."
                AND total_score IS NOT NULL
                limit 1
              ) as b,
            (
                SELECT MIN(total_score) FROM eptscore as es
                LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                WHERE ept_1.ept_date = ept.ept_date
                ".$searchdate_data_y.$searchscore_data."
                AND total_score IS NOT NULL
                limit 1
              ) as c
            FROM ept
            WHERE id_epttype = 2
            ".$searchdate_data_y."
            GROUP BY y
            ORDER BY y DESC
            LIMIT 7
          ) as ept_s2 ORDER BY ept_s2.y ASC
        ");
        // DATE_FORMAT(ept.ept_date, '%M %d, %Y')

        // PERCENTAGE BEGIN
                $daily_pass = DB::select("
                  SELECT * FROM(
                    SELECT
                    ept.ept_date as ept_date,
                    (
                        SELECT COUNT(*) FROM eptscore as es
                        LEFT JOIN registerept as reg ON es.id_registerept = reg.id
                        LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
                        WHERE ept_1.ept_date = ept.ept_date
                        ".$searchdate_data_y.$searchscore_data."
                        ORDER BY total_score DESC
                        limit 1
                      ) as jumlah
                    FROM ept
                    WHERE id_epttype = 1
                    ".$searchdate_data_y."
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
                        ".$searchdate_data_y.$searchscore_data."
                        ORDER BY total_score DESC
                        limit 1
                      ) as jumlah
                    FROM ept
                    WHERE id_epttype = 2
                    ".$searchdate_data_y."
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
                  ) as ept_s2 ORDER BY ept_s2.ept_date ASC
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
                    ".$searchdate_data_y.$searchscore_data."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    ORDER BY total_score DESC
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 1
                ".$searchdate_data_y."
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
                    ".$searchdate_data_y."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 1
                ".$searchdate_data_y."
                GROUP BY ept.ept_date
                ORDER BY ept.ept_date DESC
                LIMIT 1
              ");

                if (count($sum_latest_part) > 0) {
                    if ($sum_latest_pass[0]->jumlah == 0) {
                      $latest_pass_percentage= 0;
                    }
                    else{
                      $latest_pass_percentage = round(($sum_latest_pass[0]->jumlah/$sum_latest_part[0]->jumlah)*100,2);
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
                    ".$searchdate_data_y.$searchscore_data."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    ORDER BY total_score DESC
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 2
                ".$searchdate_data_y."
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
                    ".$searchdate_data_y."
                    AND reg.status NOT IN('Abandoned','Unverified')
                    limit 1
                  ) as jumlah
                FROM ept
                WHERE id_epttype = 2
                ".$searchdate_data_y."
                GROUP BY ept.ept_date
                ORDER BY ept.ept_date DESC
                LIMIT 1
              ");

                if (count($sum_latest_part_s2) > 0) {
                    if ($sum_latest_pass_s2[0]->jumlah == 0) {
                      $latest_pass_percentage_s2 = 0;
                    }
                    else{
                      $latest_pass_percentage_s2 = round(($sum_latest_pass_s2[0]->jumlah/$sum_latest_part_s2[0]->jumlah)*100,2);
                    }
                } else {
                  $latest_pass_percentage_s2 = 0;
                }

        // PERCENTAGE ENDED

        $searchdate_data = "";
        if ($searchdate != "" && $searchdate_end) {
          $ubah = date('d-m-Y', strtotime($searchdate));
          $ubah1 = date('d-m-Y', strtotime($searchdate_end));
          $searchdate_data = $ubah." s/d ".$ubah1;
        }
        $searchscore_data = "";
        if ($searchscore == 1) {
          $searchscore_data = "677 >= x > 600";
        } elseif ($searchscore == 2) {
          $searchscore_data = "600 >= x > 500";
        } elseif ($searchscore == 3) {
          $searchscore_data = "500 >= x > 450";
        } elseif ($searchscore == 4) {
          $searchscore_data = "450 >= x > 400";
        } elseif ($searchscore == 5) {
          $searchscore_data = "x <= 400";
        } elseif ($searchscore == 6) {
          $searchscore_data = "All Score";
        }
        $ket = array(
          "date"        => $searchdate_data,
          "searchscore" => $searchscore_data
        );

        $raw_filter = array(
          "date_start"        => $req->ept_date_start,
          "date_end"          => $req->ept_date_end,
          "searchscore_data"  => $req->ept_score
        );

        $eptchart = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='eptchart';
        return view('isept.eptvaluemanager.eptchart')->with([
            'eptchart'          => $eptchart,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'daily_pass'              => array_column($daily_pass, 'jumlah'),
            'monthly_registered'      => array_column($monthly_registered, 'jumlah'),
            'daily_passs2'            => array_column($daily_passs2, 'jumlah'),
            'monthly_registereds2'    => array_column($monthly_registereds2, 'jumlah'),
            'ept_s1'                  => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'ept_s2'                  => json_encode($ept_s2, JSON_NUMERIC_CHECK),
            'latest_pass_percentage'    => $latest_pass_percentage,
            'sum_latest_part'           => count($sum_latest_part) > 0 ? $sum_latest_part[0]->jumlah : 0,
            'latest_pass_percentage_s2' => $latest_pass_percentage_s2,
            'sum_latest_part_s2'        => count($sum_latest_part_s2) > 0 ? $sum_latest_part_s2[0]->jumlah : 0,
            'ket'             => $ket,
            'raw_filter'      => $raw_filter
        ]);
    }

// PDF FOR EPT VALUE MANAGER DOESNT AVAILABLE ON THE SCREEN
    public function pdf_university(Request $req){

      if (($req->ept_date_start == "" && $req->ept_date_end == "") || $req->ept_score == "") {
        return redirect()->route('eptvaluemanager.eptfaculty')->with('error', 'Date Range, dan Range Skor wajib diisi');
      }

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
      $searchdate_data_y = "";
      if (($searchdate != null || $searchdate != "") && ($searchdate_end != null || $searchdate_end != "")) {
        $searchdate_data = " AND (es.created_at BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
        $searchdate_data_y = " AND (ept.ept_date BETWEEN '".$searchdate."' AND '".$searchdate_end."') ";
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
        } elseif ($searchscore == 6) {
          $searchscore_data = "";
        }
      }

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
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
            WHERE ept_1.ept_date = ept.ept_date
            ".$searchdate_data.$searchscore_data."
            AND total_score = a
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as a_id,
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
          ) as c,
          (
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
            WHERE ept_1.ept_date = ept.ept_date
            ".$searchdate_data.$searchscore_data."
            AND total_score = c
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as c_id
          FROM ept
          WHERE id_epttype = 1
          ".$searchdate_data_y."
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
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
            WHERE ept_1.ept_date = ept.ept_date
            ".$searchdate_data.$searchscore_data."
            AND total_score = a
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as a_id,
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
          ) as c,
          (
            SELECT reg.id_ept FROM eptscore as es
            LEFT JOIN registerept as reg ON es.id_registerept = reg.id
            LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
            WHERE ept_1.ept_date = ept.ept_date
            ".$searchdate_data.$searchscore_data."
            AND total_score = c
            AND total_score IS NOT NULL
            ORDER BY total_score DESC
            limit 1
          ) as c_id
          FROM ept
          WHERE id_epttype = 2
          ".$searchdate_data_y."
          GROUP BY y
          ORDER BY y DESC
          LIMIT 7
        ) as ept_s1 ORDER BY ept_s1.y ASC
      ");
      // dd($ept_s2);
      $searchdate_data = "";
      if ($searchdate != "" && $searchdate_end) {
        $ubah = date('d-m-Y', strtotime($searchdate));
        $ubah1 = date('d-m-Y', strtotime($searchdate_end));
        $searchdate_data = $ubah." s/d ".$ubah1;
      }
      $searchscore_data = "";
      if ($searchscore == 1) {
        $searchscore_data = "677 >= x > 600";
      } elseif ($searchscore == 2) {
        $searchscore_data = "600 >= x > 500";
      } elseif ($searchscore == 3) {
        $searchscore_data = "500 >= x > 450";
      } elseif ($searchscore == 4) {
        $searchscore_data = "450 >= x > 400";
      } elseif ($searchscore == 5) {
        $searchscore_data = "x <= 400";
      } elseif ($searchscore == 6) {
        $searchscore_data = "All Score";
      }
      $ket = array(
        "date"    => $searchdate_data,
        "searchscore" => $searchscore_data
      );

      // return view("isept.eptvaluemanager.pdffaculty")->with([
      //   'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
      //   'ept_s1_raw'      => $ept_s1,
      //   'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
      //   'ept_s2_raw'      => $ept_s2,
      //   'ket'             => $ket,
      // ]);
      $pdf = PDFBarry::loadView("isept.eptvaluemanager.pdfuniversity", [
        'ept_s1'          => json_encode($ept_s1, JSON_NUMERIC_CHECK),
        'ept_s1_raw'      => $ept_s1,
        'ept_s2'          => json_encode($ept_s2, JSON_NUMERIC_CHECK),
        'ept_s2_raw'      => $ept_s2,
        'ket'             => $ket,
      ]);
      $pdf->setOption('enable-javascript', true);
      // $pdf->setOption('javascript-delay', 5000);
      $pdf->setOption('enable-smart-shrinking', true);
      $pdf->setOption('no-stop-slow-scripts', true);
      $fileName = "EPT UNIVERSITY ".date("Y-m-d");
      return $pdf->stream($fileName);
    }
}
