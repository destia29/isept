<?php

namespace App\Http\Controllers\islcunila\adminlcu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Type;
use App\Model\Ept;
use App\Model\Service;
use App\Model\Score;
use Carbon\Carbon;
use Auth;
use DB;
use Redirect;

class ServicesController extends Controller
{

    public function index(){
      $lcservice =Service::where('deleted_at', NULL)->get();
      // dd($announcement);
      $page ='lcuservice';
      return view('isclunila.adminclu.lcuservice')->with([
           'lcservice'		         => $lcservice,
           'page'                  => $page,
      ]);
    }

	public function postAdd(Request $req){
		$this->validate($req, [
			'name'		           => 'required|string',
			'quantity'           => 'required|string',
			'cost'		           => 'required|string',
		]);


		$input = Service::create([
        'name'          => $req->name,
        'quantity'      => $req->quantity,
        'cost'          => $req->cost,
    ]);

    if ($input) {
      return Redirect::to('isclunila/adminclu/lcuservice')->with('success', "Data Has been added to Database");
    }
    else{
      return back()->with('danger', "Failed insert new Data to Database");
    }
	}

    public function postEdit(Request $req){
  		$this->validate($req, [
  			'name'		           => 'required|string',
  			'quantity'           => 'required|string',
  			'cost'		           => 'required|string',
		]);

  		$update =Service::find($req->id_service)->update([
        'name'          => $req->name,
        'quantity'      => $req->quantity,
        'cost'          => $req->cost,
      ]);

      if ($update) {
        return Redirect::to('isclunila/adminclu/lcuservice')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change Data");
      }
    }

    public function edit($id){
        $edit = Service::where('id', $id)->first();

        // dd($adminuser);
        $page ='lcuservice';
        return view('isclunila.adminclu.editlcuservice')->with([
			      'edit'    		          => $edit,
            'page'                  => $page,
        ]);
    }

    public function delete($id){
        $data = Service::where('id', $id)->first();
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }

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
        return view('isclunila.adminclu.eptscore')->with([
			      'eptscore'      => $eptscore,
            'type'          => $type,
            'page'          => $page,
        ]);
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
        $page ='alleptscore';
        return view('isclunila.adminclu.eptscore')->with([
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
