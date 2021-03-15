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
use Storage;
use Auth;
use DB;
use PDF;
use Carbon\Carbon;

class MyprofileController extends Controller
{
    public function index(){
        $faculty = Faculty::where('deleted_at', NULL)->get();
        $myprofile = DB::table('registerept as reg')
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

        if(Auth::user()->eptparticipant->id_major != NULL){
          $list_major = Major::where('id_faculty', Auth::user()->eptparticipant->major->id_faculty)->get();
        }
        else{
          $list_major = NULL;
        }

        // $myprofile = DB::table('eptscore')
        // ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        // ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        // ->leftjoin('epttype', 'id_epttype', '=', 'epttype.id')
        // ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        // ->where('id_user', Auth::id())
        // ->orderBy('attempt', 'DESC')
        // ->get();

        // $myprofile = DB::table('registerept as reg')
        // ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        // ->leftjoin('eptscore as src', 'reg.id_registerept', '=', 'src.id')
        // ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        // ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
        // ->leftjoin('eptroom as ept_room', 'avs.id_eptroom', '=', 'ept_room.id')
        // ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        // ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        // ->leftjoin('major', 'eptpart.id_major', '=', 'major.id')
        // ->leftjoin('faculty', 'major.id_faculty', '=', 'faculty.id')
        // ->where('id_user', Auth::id())
        // ->orderBy('attempt', 'DESC')
        // ->get();
        // dd($adminuser);
        $page ='myprofile';
        return view('isept.eptparticipant.myprofile')->with([
			      'myprofile'     => $myprofile,
            'faculty'       => $faculty,
            'page'          => $page,
            'list_major'    => $list_major,
        ]);
      }
    	public function postEdit(Request $req){
    		$this->validate($req, [
          			'name'		          => 'required|string|max:100',
          			'email'		          => 'required|string|max:100',
          			'username'		      => 'required|string',
          			'p_type'            => 'required|string',
          			'place_of_birth'    => 'required|string',
          			'date_of_birth'     => 'required|string',
          			'gender'            => 'required|string',
          			'handphone_number'  => 'required|string',
                'profile_picture'   => 'image|max:200',
    		]);
            if ($req->profile_picture && $req->profile_picture_name != 'default.png') {
               Storage::disk('eptparticipant_photoprofile')->delete($req->profile_picture_name);
            }

            if ($req->profile_picture) {
                $file=$req->profile_picture;
    		    		$nameRaw=$file->getClientOriginalName();
    		    		$profile_picture_name=mt_rand(10000, 99999).'-'.$nameRaw;
    		    		Storage::disk('eptparticipant_photoprofile')->put($profile_picture_name, file_get_contents($file));
            }
            else{
                $profile_picture_name = $req->profile_picture_name;
            }

            if ($req->p_type == 1) {
                $major = NULL;
            }
            elseif ($req->p_type == 2) {
                $major = $req->id_major;
            }
    		    $checkUsername = User::where('username', $req->username)->where('id', '!=', $req->id_user)->first();

    		    if (!empty($checkUsername)) {
    		      return back()->with('warning', "Username has already taken");
    		    }

    				$update = User::find($req->id_user)->update([
    						'username'          => $req->username,
                'name'              => $req->name,
                'email'             => $req->email,
            ]);

    	      $update2 = Eptparticipant::find($req->id_eptparticipant)->update([
                'id_major'          => $major,
          			'place_of_birth'    => $req->place_of_birth,
          			'date_of_birth'     => date('Y-m-d', strtotime($req->date_of_birth)),
          			'gender'            => $req->gender,
          			'handphone_number'  => $req->handphone_number,
          			'address'           => $req->address,
    	          'profile_picture'   => $profile_picture_name,
    	      ]);

    				if ($update2) {
    					return back()->with('success', "Data Has been changed");
    				}
    				else{
    					return back()->with('danger', "Failed change Data");
    				}
        }

      	public function viewpic($id){
      		$pic = Registerept::find($id);
          $page ='myprofile';
      		return view('isept.eptparticipant.viewpic')->with([
      			'id'		=> $id,
      			'pic'	  => $pic,
            'page'  => $page,
      		]);
      	}

      	public function streampic($id){
      		$pic	= Registerept::where('id', $id)->first();
      		$pdf  = PDF::loadView('isept.eptparticipant.document.pic', compact(['pic']))->setOptions(['isRemoteEnabled' => true])->setPaper('a6', 'landscape');
      		$filename = $pic->code;



      		return $pdf->stream($filename.'.pdf');
      	}
}
