<?php

namespace App\Http\Controllers\isept\adminept;

use Illuminate\Http\Request;

use App\Http\Requests;
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
use QrCode;
use DB;

class EptcertificateController extends Controller
{
    public function index(){
      // dd(Carbon::today()->subWeeks(2));
        $eptcertificate = DB::table('registerept as reg')
        ->select([
          'reg.id as reg_id',
          'reg.status as status',
          'ept_.id as ept_id',
          'ept_room.room_name as room_name',
          'eptpart.id as eptpart_id',
          'user.name as user_name',
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
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
        ->leftjoin('eptroom as ept_room', 'avs.id_eptroom', '=', 'ept_room.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        ->whereNotIn('status', ['Abandoned', 'Unverified'])
        ->whereRaw("(`ept_`.`ept_date` <= '".Carbon::today()->subWeeks(2)."' AND `reg`.`status` NOT IN('Done'))")
        ->orwhereRaw("(`ept_`.`ept_date` >= '".Carbon::today()->subWeeks(2)."' AND `reg`.`status` IN('Done', 'Verified'))")
        // ->where('ept_.ept_date', '>=', Carbon::today()->subWeeks(2))
        ->orderBy('reg.id', 'DESC')
        ->get();

        // dd($eptcertificate);
		    // $eptparticipant = Registerept::with(['eptparticipant', 'ept'])->where('deleted_at', NULL)->get();
        // dd($adminuser);
        $page ='eptcertificate';
        return view('isept.adminept.eptcertificate')->with([
			       'eptcertificate'    	=> $eptcertificate,
             'page'               => $page,
        ]);
    }

    public function postEdit(Request $req){
    		$this->validate($req, [
    			'status'                 => 'required|string',
		    ]);
        // dd($req->status);
        if($req->status == 'Verified'){
    		$update = Registerept::where('id', $req->id_reg)->first()->update([
                'status'               => "Verified",
            ]);
    		return back()->with('success', "Status User was changed to Verified");
        }
        else{
    		$update = Registerept::where('id', $req->id_reg)->first()->update([
                'status'               => "Done",
            ]);
    		return back()->with('success', "Status User was changed to Done");
      }
    }

    public function edit($id){
        $faculty = Faculty::where('deleted_at', NULL)->get();
		    $type    = Type::where('deleted_at', NULL)->get();
        $edit    = Registerept::with(['eptparticipant', 'ept'])->where('id', $id)->first();

        // dd($adminuser);
        $page ='eptcertificate';
        return view('isept.adminept.editeptcertificate')->with([
            'faculty'               => $faculty,
            'type'                  => $type,
			      'edit'       		        => $edit,
            'page'                  => $page,
        ]);
    }

    public function searchMajor(Request $req){
        $major = Major::where('id_faculty', $req->val)->get();

        return response()->json($major);
    }

    public function getPictureProfile($name){
        $photo = Storage::disk('eptparticipant_photoprofile')->get($name);

        return $photo;
    }

    public function finish($id){
    		$update = Registerept::where('id', $id)->first()->update([
                'status'               => "Done",
            ]);
    		return back()->with('success', "Status Data was changed to Verified");
    }
}
