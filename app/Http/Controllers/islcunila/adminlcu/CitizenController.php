<?php

namespace App\Http\Controllers\islcunila\adminlcu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Staff;
use App\Model\User;
use App\Model\Role;
use App\Model\Major;
use App\Model\Faculty;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Ept;
use App\Model\Type;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;
use Redirect;
use Storage;

class CitizenController extends Controller
{
  public function lcustaff(){
		$lcustaff = Staff::orderBy('id', 'asc')->paginate(8);
        // dd($adminuser);
        $page ='lcustaff';
        return view('isclunila.adminclu.lcustaff')->with([
			      'lcustaff'      => $lcustaff,
            'page'          => $page,
        ]);
  }

	public function postAddStaff(Request $req){
		$this->validate($req, [
			'name'		           => 'required|string|max:100',
			'position'           => 'required|string',
			'facebook'		       => 'required|string',
			'twitter'		         => 'required|string',
			'googleplus'		     => 'required|string',
			'instagram'		       => 'required|string',
      'staff_photoprofile' => 'image|max:1024',
		]);


    if ($req->staff_photoprofile) {
        $file=$req->staff_photoprofile;
    		$nameRaw=$file->getClientOriginalName();
    		$filename=mt_rand(100, 999).'-'.$nameRaw;
    		Storage::disk('staff_photoprofile')->put($filename, file_get_contents($file));
    }
    else{
        $filename = "default.png";
    }


		$input = Staff::create([
        'name'          => $req->name,
        'position'      => $req->position,
        'facebook'      => $req->facebook,
        'twitter'       => $req->twitter,
        'googleplus'    => $req->googleplus,
        'instagram'     => $req->instagram,
        'picture'       => $filename,
    ]);

    if ($input) {
      return Redirect::to('isclunila/adminclu/lcustaff')->with('success', "Data Has been added to Database");
    }
    else{
      return back()->with('danger', "Failed insert new Data to Database");
    }
	}

    public function getStaffPicture($name){
        $photo = Storage::disk('staff_photoprofile')->get($name);

        return $photo;
    }

    public function postEditStaff(Request $req){
		$this->validate($req, [
			'name'		          => 'required|string|max:100',
			'position'          => 'required|string',
			'facebook'		      => 'required|string',
			'twitter'		        => 'required|string',
			'googleplus'		    => 'required|string',
			'instagram'		      => 'required|string',
		]);


    if ($req->picture) {
       Storage::disk('staff_photoprofile')->delete($req->lcustaff_picture_name);
    }

    if ($req->picture) {
        $file=$req->picture;
		$nameRaw=$file->getClientOriginalName();
		$lcustaff_picture_name=mt_rand(10000, 99999).'-'.$nameRaw;
		Storage::disk('staff_photoprofile')->put($lcustaff_picture_name, file_get_contents($file));
    }
    else{
        $lcustaff_picture_name = $req->lcustaff_picture_name;
    }

		$update = Staff::find($req->id_staff)->update([
            'name'          => $req->name,
            'position'      => $req->position,
            'facebook'      => $req->facebook,
            'twitter'       => $req->twitter,
            'googleplus'    => $req->googleplus,
            'instagram'     => $req->instagram,
            'picture'       => $lcustaff_picture_name,
        ]);

    if ($update) {
      return Redirect::to('isclunila/adminclu/lcustaff')->with('success', "Data Has been changed");
    }
    else{
      return back()->with('danger', "Failed change Data");
      }
    }

    public function editStaff($id){
        $edit = Staff::where('id', $id)->first();

        // dd($adminuser);
        $page ='lcustaff';
        return view('isclunila.adminclu.editlcustaff')->with([
			      'edit'    		        => $edit,
            'page'                  => $page,
        ]);
    }

    public function deleteStaff($id){
        $data = Staff::where('id', $id)->first();
        $photo = Storage::disk('staff_photoprofile')->delete($data->picture);
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }

    public function findparticipant(){
      $type = Type::where('deleted_at', NULL)->get();
      $faculty = Faculty::where('deleted_at', NULL)->get();
      $list_major = Major::where('deleted_at', NULL)->get();
      $page ='eptparticipant';
      return view('isclunila.adminclu.findeptparticipant', compact(['type','page', 'faculty', 'list_major']));
    }

    public function findparticipantbynpmname(Request $req){

        $searchnpmname = $req->ept_npm_name;

        $eptparticipant = User::
            whereHas('eptparticipant', function ($query) use ($searchnpmname) {
                $query->where('username', 'like', '%' . $searchnpmname . '%');
            })
            ->orWhere('name', 'like', '%' . $searchnpmname . '%')
            ->where('users.deleted_at', NULL)
            ->where('id_role', 7)
            ->orderBy('users.id', 'DESC')
            ->get();
        // echo json_encode($data);
        // die;
        $page ='eptparticipant';
        return view('isclunila.adminclu.eptparticipant', compact(['page', 'searchnpmname', 'eptparticipant']));
    }

    public function findparticipantbycategory(Request $req){

        $id_major = $req->id_major;
        $searchnpmname = $req->ept_npm_name;
        // dd($searchdate);
        $eptparticipant = User::
            whereHas('eptparticipant', function ($query) use ($searchnpmname, $id_major) {
                $query->where('idnumber_eptparticipant', 'like', '%' . $searchnpmname . '%')
                      ->where('id_major', $id_major);
            })
            // ->whereHas('eptparticipant', function ($query) use ($id_major) {
            //     $query->where('id_major', $id_major);
            // })
            ->Where('name', 'like', $searchnpmname . '%')
            ->where('users.deleted_at', NULL)
            ->where('id_role', 7)
            ->orderBy('users.id', 'DESC')
            ->get();


        // echo json_encode($eptparticipant);
        // die;
        // dd($eptparticipant);

        $page ='eptparticipant';
        return view('isclunila.adminclu.eptparticipant', compact(['page', '$searchnpmname', 'eptparticipant']));
    }

    public function searchMajor(Request $req){
        $major = Major::where('id_faculty', $req->val)->get();

        return response()->json($major);
    }

    public function findeptparticipant(){
        // $eptparticipant = Eptparticipant::with(['registerept', 'user', 'major'])->where('deleted_at', NULL)
        // ->orderBy('id', 'DESC')->get();

        $eptparticipant = User::where('users.deleted_at', NULL)
            ->where('id_role', 7)
            ->orderBy('users.id', 'DESC')
            ->get();

        // dd($adminuser);
        $page ='eptparticipant';
        //return view('isclunila.adminclu.eptparticipant', compact(['page', 'eptparticipant']));
        return view('isclunila.adminclu.eptparticipant')->with([
			      'eptparticipant'      => $eptparticipant,
            'page'                => $page,
        ]);
    }

    public function findparticipantselectdate(Request $req){
        $searchtype = $req->ept_type;

        $searchdate = date('Y-m-d', strtotime($req->ept_date));
        // dd($searchdate);
        $eptparticipant = DB::table('registerept as reg')
        ->select([
          'reg.id as reg_id',
          'reg.status as status',
          'ept_.id as ept_id',
          'ept_room.room_name as room_name',
          'eptpart.id as eptpart_id',
          'user.name as user_name',
          'ept_.ept_date as ept_eptdate',
          'ept_.ept_time as ept_epttime',
          'ept_type.type as ept_epttype',
          'ept_.registration_date as ept_registrationdate',
          'eptpart.idnumber_eptparticipant as eptpart_idnumber',
          'faculty.faculty_name as faculty_name',
          'major.id as id_major',
          'major.major_name as major_name',
          'reg.attempt as attempt',
        ])
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
        ->leftjoin('eptroom as ept_room', 'avs.id_eptroom', '=', 'ept_room.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->where('reg.deleted_at', NULL)
        ->where('ept_type.id', $searchtype)
        ->where('ept_.ept_date', $searchdate)
        ->get();

        // dd($eptparticipant);

        $page ='findparticipant';
        return view('isept.adminept.eptparticipant', compact(['page', 'searchdate', 'searchtype', 'eptparticipant']));
    }

  	public function postAddEptParticipant(Request $req){
      $this->validate($req, [
        'idnumber_eptparticipant'		 => 'required|string|min:8|unique:eptparticipant',
      ]);
      $password = 'lcunila';
      $insert = User::create([
          'id_role'                      => 7,
          'username'                     => $req->idnumber_eptparticipant,
          'password'                     => bcrypt($password),
      ]);

      $input = Eptparticipant::create([
          'id_user'                      => $insert->id,
          'idnumber_eptparticipant'      => $req->idnumber_eptparticipant,
      ]);

      if ($input) {
        return redirect()->route('adminlcunila.findparticipant.find')->with('success', "You have successfully registered an EPT Participant");
      }
      else{
        return back()->with('danger', "Failed insert new Data to Database");
      }
    }

    public function postEditeptparticipant(Request $req){
  		$this->validate($req, [
  			'idnumber_eptparticipant'		 => 'required|string',
  			'username'		               => 'required|string',
  			'name'		                   => 'required|string',
  			'userstatus'                 => 'required|string',
		]);
      $checkIDnumber = Eptparticipant::where('idnumber_eptparticipant', $req->idnumber_eptparticipant)->where('id', '!=', $req->id_eptparticipant)->first();

      if (!empty($checkIDnumber)) {
        return back()->with('warning', "ID Number EPT Participant has already taken");
      }
      $checkUsername = User::where('username', $req->username)->where('id', '!=', $req->id_userparticipant)->first();

      if (!empty($checkUsername)) {
        return back()->with('warning', "Username has already taken");
      }
      $password = 'lcunila';
      $update1 = User::where('id', $req->id_userparticipant)->update([
          'username'                     => $req->username,
          'name'                         => $req->name,
          'password'                     => bcrypt($password),
      ]);

      $update2 = Eptparticipant::where('id', $req->id_eptparticipant)->update([
          'idnumber_eptparticipant'      => $req->idnumber_eptparticipant,
          'userstatus'                   => $req->userstatus,
      ]);

      if ($update2) {
        return redirect()->route('adminlcunila.findparticipant.find')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change Data");
      }
    }

    public function editeptparticipant($id){
        $edit = Eptparticipant::with(['user'])->where('id', $id)->first();

        $page ='eptparticipant';
        return view('isclunila.adminclu.editeptparticipant')->with([
			      'edit'    		          => $edit,
            'page'                  => $page,
        ]);
    }

    public function exportformatfile(){

      $excel  = Excel::create('LCUnila-'.'ImportISEPTAccount-FormatFile', function($excel) {

         $excel->setTitle('ImportISEPTAccount-FormatFile');
         $excel->setCreator('David Abror');
         $excel->setLastModifiedBy(Auth::user()->name);
         $excel->setManager("David Abror");
         $excel->setCompany("Ryu Consolidated");

        $excel->sheet('Sheet1', function($sheet) {
          $sheet->setAllBorders('solid');
          $sheet->loadView('isclunila.adminclu.exportformatfile_csv');
        });

      })->download('csv');
    }

    public function import(Request $req){
      $this->validate($req, [
        'file_import'  		=> 'required'
      ]);

      $file     		= $req->file('file_import');

      $test = Excel::load($file, function($render){
      $result		= $render->get();
        foreach ($result as $key => $value) {
          $check = Eptparticipant::where('idnumber_eptparticipant', $value->idnumber_eptparticipant)->first();
          if (empty($check)) {
            $password = 'lcunila';
            $insert = User::create([
                'id_role'     => 7,
                'name'        => $value->name,
                'username'    => $value->idnumber_eptparticipant,
                'password'    => bcrypt($password)
            ]);

            $input = Eptparticipant::create([
                'id_user'                      => $insert->id,
                'idnumber_eptparticipant'      => $value->idnumber_eptparticipant,
            ]);
          }
        }
      });

      return back()->with('success', "Import data succesfull");
    }

    public function deleteeptparticipant($id){
        $data = Eptparticipant::where('id', $id)->first();
        $check = Registerept::where('id_eptparticipant', $data->id)->whereIn('status', ['Verified', 'Done'])->first();
        if (empty($check)) {

          if ($data->profile_picture != 'default.png') {
            $photo              = Storage::disk('eptparticipant_photoprofile')->delete($data->profile_picture);
          }
          $id = $data->user->id;

          $delete    = Eptparticipant::where('id', $id)->forceDelete();
          $user      = User::where('id', $id)->forceDelete();

        }
        else{
          return back()->with('error', 'Data was unsuccessfully deleted');
        }
        return back()->with('success', 'Data was successfully deleted');
    }

    public function activate($id){
    		$update = Eptparticipant::where('id', $id)->first()->update([
                'userstatus'               => "Active",
            ]);
    		return back()->with('success', "Status User was changed to Active");
    }

    public function suspend($id){
    		$update = Eptparticipant::where('id', $id)->first()->update([
                'userstatus'               => "Nonactive",
            ]);
    		return back()->with('success', "Status User was changed to Nonactive");
    }

    public function resetpassword($id){
        $password = 'lcunila';
    		$participant = Eptparticipant::with(['user'])->where('id', $id)->first();
    		$update = User::where('id', $participant->id_user)->first()->update([
                'password'               => bcrypt($password),
            ]);
        // dd($update->email);
    		return back()->with('success', "Password ISEPT Account was successfully reseted");
    }
}
