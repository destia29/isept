<?php

namespace App\Http\Controllers\isept\eptparticipant;

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
use App\Model\Availableseat;
use App\Model\Room;
use App\Model\Type;
use App\Model\Score;
use Storage;
use Auth;
use DB;
use QrCode;
use File;
use Response;
use Carbon\Carbon;


class RegistereptController extends Controller
{
    private $student = 'S1_D3';
    private $public = 'S2_Public';

    public function index(){
        $registerept = DB::table('registerept as reg')
        ->select([
          'reg.id as reg_id',
          'reg.status as status',
          'reg.updated_at as regupdated_at',
          'reg.id_eptparticipant as eptpartid',
          'ept_.id as ept_id',
          'ept_room.room_name as room_name',
          'eptpart.id as eptpart_id',
          'user.name as user_name',
          'ept_.ept_date as ept_eptdate',
          'ept_.ept_time as ept_epttime',
          'ept_.registration_date as ept_registrationdate',
          'eptpart.idnumber_eptparticipant as eptpart_idnumber',
        ])
        ->leftjoin('ept as ept_', 'reg.id_ept', '=', 'ept_.id')
        ->leftjoin('epttype as ept_type', 'ept_.id_epttype', '=', 'ept_type.id')
        ->leftjoin('availableseat as avs', 'reg.id_availableseat', '=', 'avs.id')
        ->leftjoin('eptroom as ept_room', 'avs.id_eptroom', '=', 'ept_room.id')
        ->leftjoin('eptparticipant as eptpart', 'reg.id_eptparticipant', '=', 'eptpart.id')
        ->leftjoin('users as user', 'eptpart.id_user', '=', 'user.id')
        ->whereNotIn('status', ['Abandoned', 'Done'])
        ->where('reg.id_eptparticipant', Auth::user()->eptparticipant->id)
        ->where('ept_date', '>=', Carbon::today().' 00:00:00')
        ->orderBy('regupdated_at', 'DESC')
        ->first();
        if($registerept != NULL){
          $gettimereg = Carbon::parse($registerept->ept_registrationdate)->addHours(24)->subMinute();
          $getdatetest = Carbon::parse($registerept->ept_eptdate);
          $gettimetest = Carbon::parse($registerept->ept_epttime);
        }
        else{
          $gettimereg  = NULL;
          $getdatetest = NULL;
          $gettimetest = NULL;
        }


        $failept1 = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->where('id_epttype', 1)
        ->where('total_score', '<', 450)
        ->count();

        $failept2 = DB::table('eptscore')
        ->leftjoin('registerept', 'id_registerept', '=', 'registerept.id')
        ->leftjoin('ept', 'id_ept', '=', 'ept.id')
        ->leftjoin('eptparticipant', 'id_eptparticipant', '=', 'eptparticipant.id')
        ->where('id_user', Auth::id())
        ->where('id_epttype', 2)
        ->where('total_score', '<', 450)
        ->count();

        $faculty = Faculty::where('deleted_at', NULL)->get();
		    $type = Type::where('deleted_at', NULL)->get();
        $participant = Eptparticipant::where('id_user', Auth::id())->first();
        if(Auth::user()->eptparticipant->id_major != NULL){
          $list_major = Major::where('id_faculty', Auth::user()->eptparticipant->major->id_faculty)->get();
        }
        else{
          $list_major = NULL;
        }
        $page ='registerept';
        // dd($registerept);
        return view('isept.eptparticipant.registerept')->with([
            'page'                  => $page,
            'type'                  => $type,
            'faculty'               => $faculty,
            'participant'           => $participant,
            'list_major'            => $list_major,
            'registerept'           => $registerept,
            'gettimereg'            => $gettimereg,
            'getdatetest'           => $getdatetest,
            'gettimetest'           => $gettimetest,
            'failept1'              => $failept1,
            'failept2'              => $failept2,

        ]);
	}

    public function registerEpt(Request $req){
        // dd($req->all());
		$this->validate($req, [
			'name'		          => 'required|string|max:100',
			'participant_type'  => 'required|string',
			'email'             => 'required|string',
			'place_of_birth'    => 'required|string',
			'date_of_birth'     => 'required|string',
			'gender'            => 'required|string',
			'handphone_number'  => 'required|string',
			'id_ept'            => 'required|string',
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

        if ($req->participant_type == 1) {
            $major = NULL;
        }
        elseif ($req->participant_type == 2) {
            $major = $req->id_major;
        }

        $updateUser = User::where('id', $req->id_user)->first();
        $updateUser->name = $req->name;
        $updateUser->email = $req->email;
        $updateUser->save();

        $participant = Eptparticipant::where('id_user', $req->id_user)->first();

        $updateParticipant = Eptparticipant::where('id_user', $req->id_user)->first();
        $updateParticipant->id_major            = $major;
        $updateParticipant->place_of_birth      = $req->place_of_birth;
        $updateParticipant->date_of_birth       = date('Y-m-d', strtotime($req->date_of_birth));
        $updateParticipant->gender              = $req->gender;
        $updateParticipant->address             = $req->address;
        $updateParticipant->handphone_number    = $req->handphone_number;
        $updateParticipant->profile_picture     = $profile_picture_name;
        $updateParticipant->save();

        // if ($req->ept_type == 1) {
        //     $code = 'LCUNILA'.'-'.$this->student.'-'.date('m-d-Y', strtotime($req->ept_date)).'-'.$req->name.'-'.$participant->idnumber_eptparticipant;
        // }
        // else {
        //     $code = 'LCUNILA'.'-'.$this->public.'-'.date('m-d-Y', strtotime($req->ept_date)).'-'.$req->name.'-'.$participant->idnumber_eptparticipant;
        // }

        $check      = Registerept::where('id_eptparticipant', $participant->id)->where('id_ept', $req->id_ept)->orderBy('created_at', 'DESC')->first();
        $countnotabandon = Registerept::where('id_eptparticipant', $participant->id)->whereNotIn('status', ['Abandoned'])->count();
        // dd($checkabandon);

        if (!empty($check)) {
            return back()->with('warning', 'You have already registered at this date before!');
        }
        else{
            $attempt    = Registerept::select('attempt')->where('id_eptparticipant', $participant->id)->orderBy('created_at', 'DESC')->first();
            // $qr_code    = $code.'.png';
            // $qr         = QrCode::format('png')->size(200)->margin(0)->generate($code);
            // Storage::disk('qr-code_participant')->put($qr_code, $qr);

            if(empty($attempt)){
                $total_attempt = 1;
            }
            else{
                $total_attempt = $countnotabandon + 1 ;
            }

            $available_ID = Availableseat::where('isfull', 0)->where('id_ept', $req->id_ept)->first();

            if (empty($available_ID)) {
              return back()->with('danger', "This time has already full, Please choose another time!");
            }

            $register = Registerept::create([
                'id_eptparticipant' => $participant->id,
                'id_ept'            => $req->id_ept,
                // 'code'              => $code,
                // 'qr_code'           => $qr_code,
                'attempt'           => $total_attempt,
                'id_availableseat'  => $available_ID->id,
            ]);

    		    $input = Score::create([
                'id_registerept'   => $register->id,
            ]);
        }

        return back()->with('success', 'You have been succesfully registered!');
    }

    public function searchMajor(Request $req){
        $major = Major::where('id_faculty', $req->val)->get();

        return response()->json($major);
    }

    public function getPictureProfile($name){
        $photo = Storage::disk('eptparticipant_photoprofile')->get($name);

        return $photo;
    }

    public function getPictureProfileCetak($name){
      dd(public_path('storage/eptparticipant_photoprofile'.Auth::user()->eptparticipant->profile_picture));

        $photo = Storage::disk('eptparticipant_photoprofile')->get($name);
        $type = Storage::disk('eptparticipant_photoprofile')->mimeType($name);

        if (!$photo) {
            abort(404);
        }

        $response = Response::make($photo, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function searchEptType(Request $req){
        $type = Type::where('id', $req->val)->first();
        $data['type'] = DB::table('ept')
                    ->select('ept.ept_date')
                    ->join('availableseat', 'ept.id', '=', 'availableseat.id_ept')
                    ->where('availableseat.isfull', 0)
                    ->where('ept_date', '>=', Carbon::today())
                    ->where('id_epttype', $req->val)
                    ->distinct('ept_date')
                    ->orderBy('ept_date', 'ASC')
                    ->get();
        $data['cost'] = $type->modif_cost;
        // $before = Ept::select(['ept_date'])->where('ept_date', '>=', Carbon::today().' 00:00:00')->where('id_epttype', $req->val)->get();
        // $data['ept_date'] = date('d F Y', strtotime($before));

        return response()->json($data);
    }

    public function searchEptTypeUniversal(Request $req){
        $type = Type::where('id', $req->val)->first();
        $data['type'] = Ept::whereHas('availableseat', function($query){
          $query->where('isfull', 0);
        })->select(['ept_date', 'id'])->where('ept_date', '>=', Carbon::today()->subWeeks(2).' 00:00:00')->where('id_epttype', $req->val)->groupBy('ept_date')->get() ;

        return response()->json($data);
    }

    public function searchEptDate(Request $req){
        $data = Ept::select(['id', 'ept_time'])->where('ept_date', $req->val)->where('id_epttype', $req->id_epttype)->orderBy('ept_time', 'ASC')->get();

        return response()->json($data);

        // $data = Ept::with(['availableseat'])->select(['id', 'ept_time'])->where('ept_date', $req->val)->where('id_epttype', $req->id_epttype)->orderBy('ept_time', 'ASC')->get();
        // return response()->json($data);
    }
}
