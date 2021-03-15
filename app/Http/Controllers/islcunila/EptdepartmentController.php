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
use PDFBarry;
class EptdepartmentController extends Controller
{
  public function index(){

        $ept_s1 = $this->get_data();
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

        $selectFaculty = DB::table("faculty")->select("*")->get();
        $selectGrade = DB::table("epttype")->select("*")->get();

        $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
        // dd($adminuser);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        $page ='eptdepartment';

        // ICHSAN : DEFINE CHART MORRIS BAR
        return view('isclunila.eptdepartment')->with([
      			'homepage'         => $homepage,
            'eptverified'       => $eptverified,
            'registered'        => $registered,
            'page'              => $page,
            'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
            'batch'             => array(),
            'jumlah_batch'      => 0,
            'select_faculty'    => $selectFaculty,
            'select_grade'      => $selectGrade
      			]);
  }

  public function selectfaculty(Request $req){
      $searchfaculty = $req->ept_faculty;
      $searchtype  = $req->ept_type;

      $searchdate = "";
      $searchdate_end = "";
      if ($req->ept_date_start != "") {
        $searchdate = date('Y-m-d', strtotime($req->ept_date_start));
      }
      if ($req->ept_date_end != "") {
        $searchdate_end = date('Y-m-d', strtotime($req->ept_date_end));
      }

      $search_score = "";
      if ($req->ept_score != "") {
        $search_score = $req->ept_score;
      }

      $ept_s1 = $this->get_data($searchfaculty, $searchtype, $searchdate, $searchdate_end, $search_score);
      // DATE_FORMAT(ept.ept_date, '%M %d, %Y')

      $faculty = DB::table("faculty")->select("*")->where("id", $searchfaculty)->first();
      $searchfaculty = $faculty->faculty_name;
      if ($searchtype != 0 || $searchtype != "") {
        $type = DB::table("epttype")->select("*")->where("id", $searchtype)->first();
        $searchtype = $type->type;
      }
      $searchdate_data = "";
      if ($searchdate != "" && $searchdate_end) {
        $ubah = date('d-m-Y', strtotime($searchdate));
        $ubah1 = date('d-m-Y', strtotime($searchdate_end));
        $searchdate_data = $ubah." s/d ".$ubah1;
      }
      $searchscore_data = "";
      if ($search_score == 1) {
        $searchscore_data = "677 >= x > 600";
      } elseif ($search_score == 2) {
        $searchscore_data = "600 >= x > 500";
      } elseif ($search_score == 3) {
        $searchscore_data = "500 >= x > 450";
      } elseif ($search_score == 4) {
        $searchscore_data = "450 >= x > 400";
      } elseif ($search_score == 5) {
        $searchscore_data = "x <= 400";
      } elseif ($search_score == 6) {
        $searchscore_data = "All Score";
      }
      $ket = array(
        "faculty" => $searchfaculty,
        "epttype" => $searchtype,
        "date"    => $searchdate_data,
        "searchscore" => $searchscore_data
      );

      $raw_filter = array(
        "faculty" => $req->ept_faculty,
        "epttype" => $req->ept_type,
        "date_start"    => $req->ept_date_start,
        "date_end"      => $req->ept_date_end,
        "searchscore_data"  => $req->ept_score
      );

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

      $selectFaculty = DB::table("faculty")->select("*")->get();
      $selectGrade = DB::table("epttype")->select("*")->get();

      $homepage = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->get();
      // dd($adminuser);
      $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

      $registered =  Registerept::where('status', "Verified")->get();
      $page ='eptdepartment';
      $per_bar = 3;

      $data = [];
      $jumlah = 0;
      $batching = [];
      foreach ($ept_s1 as $key => $item) {
        $batching[] = $item;
        $jumlah++;
        if ($jumlah >= $per_bar) {
          $jumlah = 0;
          $data[] = $batching;
          $batching = [];
        }
      }
      if (count($batching) > 0) {
        $data[] = $batching;
      }
      // dd($data);
      return view('isclunila.eptdepartment')->with([
          'homepage'         => $homepage,
          'eptverified'       => $eptverified,
          'registered'        => $registered,
          'page'              => $page,
          'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
          'batch'             => $data,
          'jumlah_batch'      => count($data),
          'select_faculty'    => $selectFaculty,
          'select_grade'      => $selectGrade,
          'ket'               => $ket,
          'raw_filter'        => $raw_filter
          ]);
  }

  public function pdf(Request $req){
    // $html = "<h1>HELLO WORLD</h1>";

    if ($req->ept_faculty == "" || ($req->ept_date_start == "" && $req->ept_date_end == "") || $req->ept_score == "") {
      return redirect()->route('eptvaluemanager.eptdepartment')->with('error', 'Fakultas, Date Range, dan Date Skor wajib diisi');
    }

    $searchfaculty = $req->ept_faculty;
    // $searchfaculty = 3;
    $searchtype  = $req->ept_type;

    $searchdate = "";
    $searchdate_end = "";
    if ($req->ept_date_start != "") {
      $searchdate = date('Y-m-d', strtotime($req->ept_date_start));
    }
    if ($req->ept_date_end != "") {
      $searchdate_end = date('Y-m-d', strtotime($req->ept_date_end));
    }

    $search_score = "";
    if ($req->ept_score != "") {
      $search_score = $req->ept_score;
    }
    // $search_score = 3;

    $ept_s1 = $this->get_data($searchfaculty, $searchtype, $searchdate, $searchdate_end, $search_score);

    $per_bar = 5;

      $data = [];
      $jumlah = 0;
      $batching = [];
      foreach ($ept_s1 as $key => $item) {
        $batching[] = $item;
        $jumlah++;
        if ($jumlah >= $per_bar) {
          $jumlah = 0;
          $data[] = $batching;
          $batching = [];
        }
      }
      if (count($batching) > 0) {
        $data[] = $batching;
      }

    $faculty = DB::table("faculty")->select("*")->where("id", $searchfaculty)->first();
    $searchfaculty = $faculty->faculty_name;
    if ($searchtype != 0 || $searchtype != "") {
      $type = DB::table("epttype")->select("*")->where("id", $searchtype)->first();
      $searchtype = $type->type;
    } else {
      $searchtype = "All Degree";
    }
    $searchdate_data = "";
    if ($searchdate != "" && $searchdate_end) {
      $ubah = date('d-m-Y', strtotime($searchdate));
      $ubah1 = date('d-m-Y', strtotime($searchdate_end));
      $searchdate_data = $ubah." s/d ".$ubah1;
    }

    if ($search_score == 1) {
      $searchscore_data = "677 >= x > 600";
    } elseif ($search_score == 2) {
      $searchscore_data = "600 >= x > 500";
    } elseif ($search_score == 3) {
      $searchscore_data = "500 >= x > 450";
    } elseif ($search_score == 4) {
      $searchscore_data = "450 >= x > 400";
    } elseif ($search_score == 5) {
      $searchscore_data = "x <= 400";
    } elseif ($search_score == 6) {
      $searchscore_data = "All Score";
    }
    $ket = array(
      "faculty" => $searchfaculty,
      "epttype" => $searchtype,
      "date"    => $searchdate_data,
      "searchscore_data"  => $searchscore_data
    );

    // return view('isclunila.pdfdepartment')->with([
    //   'ept_s1_raw'        => $ept_s1,
    //   'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
    //   'batch'             => $data,
    //   'jumlah_batch'      => count($data),
    //   'ket'        => $ket
    // ]);
    $pdf = PDFBarry::loadView("isclunila.pdfdepartment", [
      'ept_s1_raw'        => $ept_s1,
      'ept_s1'            => json_encode($ept_s1, JSON_NUMERIC_CHECK),
      'batch'             => $data,
      'jumlah_batch'      => count($data),
      'ket'        => $ket
    ])->setPaper('a4','landscape');
    $pdf->setOption('enable-javascript', true);
    // $pdf->setOption('javascript-delay', 5000);
    $pdf->setOption('enable-smart-shrinking', true);
    $pdf->setOption('no-stop-slow-scripts', true);
    $fileName = "EPT Department Chart Report - ".date("Y-m-d");
    return $pdf->stream($fileName);
  }

  private function get_data($searchfaculty = null, $searchtype = null, $searchdate = null, $searchdate_end = null, $searchscore = null) {
    $data = "";
    if ($searchfaculty != null) {
      $searchtype_data = "";
      if ($searchtype != 0 || $searchtype != "") {
        if ($searchtype == 1) {
          $searchtype_data = " AND ept.id_epttype = 1";
        }
        if ($searchtype == 2) {
          $searchtype_data = " AND ept.id_epttype = 2";
        }
        //$searchtype_data = " AND ept.id_epttype = ".$searchtype." ";
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

      $data = DB::select("SELECT * FROM
                ( SELECT majj.major_name as y,
                  ( SELECT MAX(total_score) FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as a,
                  ( SELECT username FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN users as user ON eptpart.id_user = user.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = a
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as a_id,
                  (
                    SELECT name FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN users as user ON eptpart.id_user = user.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = a
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                ) as name,
                  ( SELECT ept.ept_date FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = a
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as a_date,
                  (
                    SELECT FLOOR(AVG(total_score)) FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE  majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score IS NOT NULL
                    limit 1
                  ) as b,
                  ( SELECT username FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN users as user ON eptpart.id_user = user.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = b
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as b_id,
                  ( SELECT ept.ept_date FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = b
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as b_date,
                  (
                    SELECT MIN(total_score) FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE  majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score IS NOT NULL
                    limit 1
                  ) as c,
                  ( SELECT username FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN users as user ON eptpart.id_user = user.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = c
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as c_id,
                  (
                    SELECT name FROM eptscore as es
                      INNER JOIN registerept as reg ON es.id_registerept = reg.id
                      INNER JOIN ept as ept ON reg.id_ept = ept.id
                      INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                      INNER JOIN users as user ON eptpart.id_user = user.id
                      INNER JOIN major as maj ON eptpart.id_major = maj.id
                      INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                      WHERE majj.major_name = maj.major_name
                      ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                      AND total_score = c
                      AND total_score IS NOT NULL
                      ORDER BY total_score DESC
                      limit 1
                  ) as name2,
                  ( SELECT ept.ept_date FROM eptscore as es
                    INNER JOIN registerept as reg ON es.id_registerept = reg.id
                    INNER JOIN ept as ept ON reg.id_ept = ept.id
                    INNER JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
                    INNER JOIN major as maj ON eptpart.id_major = maj.id
                    INNER JOIN faculty as fac ON maj.id_faculty = fac.id
                    WHERE majj.major_name = maj.major_name
                    ".$searchdate_data_y.$searchscore_data.$searchtype_data."
                    AND total_score = c
                    AND total_score IS NOT NULL
                    ORDER BY total_score DESC
                    limit 1
                  ) as c_date,
                  ept.ept_date
                  FROM  major as majj INNER JOIN faculty as faculty  ON faculty.id = majj.id_faculty
                  INNER JOIN eptparticipant as eptpart ON eptpart.id_major = majj.id
                  INNER JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
                  INNER JOIN ept as ept ON reg.id_ept = ept.id
                  WHERE faculty.id = ".$searchfaculty."
                  ".$searchdate_data_y."
                  GROUP BY y
                  ORDER BY y ASC
                ) as ept_s1 ORDER BY ept_date DESC, ept_s1.y ASC
      ");
      foreach ($data as $key => $value) {
        if ($value->a == null || $value->a == "") {
          $value->a = 0;
        }
        if ($value->b == null || $value->b == "") {
          $value->b = 0;
        }
        if ($value->c == null || $value->c == "") {
          $value->c = 0;
        }
      }

      // dd($data);
    } else {
      // $data = DB::select("
      //   SELECT * FROM(
      //     SELECT
      //     ept.ept_date as y,
      //     (
      //         SELECT MAX(total_score) FROM eptscore as es
      //         LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      //         LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
      //         WHERE ept_1.ept_date = ept.ept_date
      //         AND total_score IS NOT NULL
      //         ORDER BY total_score DESC
      //         limit 1
      //       ) as a,
      //     (
      //         SELECT FLOOR(AVG(total_score)) FROM eptscore as es
      //         LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      //         LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
      //         WHERE ept_1.ept_date = ept.ept_date
      //         AND total_score IS NOT NULL
      //         limit 1
      //       ) as b,
      //     (
      //         SELECT MIN(total_score) FROM eptscore as es
      //         LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      //         LEFT JOIN ept as ept_1 ON reg.id_ept = ept_1.id
      //         WHERE ept_1.ept_date = ept.ept_date
      //         AND total_score IS NOT NULL
      //         limit 1
      //       ) as c
      //     FROM ept
      //     WHERE id_epttype = 1
      //     GROUP BY y
      //     ORDER BY y DESC
      //     LIMIT 7
      //   ) as ept_s1 ORDER BY ept_s1.y ASC
      //   ");
      // $data = DB::select("SELECT * FROM
      //           ( SELECT majj.major_name as y,
      //             ( SELECT MAX(total_score) FROM eptscore as es
      //               LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      //               LEFT JOIN ept as ept ON reg.id_ept = ept.id
      //               LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
      //               LEFT JOIN major as maj ON eptpart.id_major = maj.id
      //               LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
      //               WHERE majj.major_name = maj.major_name
      //               AND ept.id_epttype = 1
      //               AND total_score IS NOT NULL
      //               ORDER BY total_score DESC
      //               limit 1
      //             ) as a,
      //             (
      //               SELECT FLOOR(AVG(total_score)) FROM eptscore as es
      //               LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      //               LEFT JOIN ept as ept ON reg.id_ept = ept.id
      //               LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
      //               LEFT JOIN major as maj ON eptpart.id_major = maj.id
      //               LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
      //               WHERE  majj.major_name = maj.major_name
      //               AND ept.id_epttype = 1
      //               AND total_score IS NOT NULL
      //               limit 1
      //             ) as b,
      //             (
      //               SELECT MIN(total_score) FROM eptscore as es
      //               LEFT JOIN registerept as reg ON es.id_registerept = reg.id
      //               LEFT JOIN ept as ept ON reg.id_ept = ept.id
      //               LEFT JOIN eptparticipant as eptpart ON reg.id_eptparticipant = eptpart.id
      //               LEFT JOIN major as maj ON eptpart.id_major = maj.id
      //               LEFT JOIN faculty as fac ON maj.id_faculty = fac.id
      //               WHERE  majj.major_name = maj.major_name
      //               AND ept.id_epttype = 1
      //               AND total_score IS NOT NULL
      //               limit 1
      //             ) as c
      //             FROM  major as majj LEFT JOIN faculty as faculty  ON faculty.id = majj.id_faculty
      //             LEFT JOIN eptparticipant as eptpart ON eptpart.id_major = majj.id
      //             LEFT JOIN registerept as reg ON reg.id_eptparticipant = eptpart.id
      //             LEFT JOIN ept as ept ON reg.id_ept = ept.id
      //             WHERE ept.id_epttype = 1
      //             GROUP BY y
      //             ORDER BY y DESC
      //           ) as ept_s1 ORDER BY ept_s1.y ASC
      // ");
    }
    return $data;
  }
}
