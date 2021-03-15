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
use App\Model\Availableseat;
use App\Model\Ept;
use App\Model\Type;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use QrCode;
use DB;

class EptparticipantController extends Controller
{
    public function index(){
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
        ->whereNotIn('status', ['Abandoned'])
        ->where('ept_.ept_date', '>=', Carbon::today().' 00:00:00')
        ->orderBy('reg.id', 'DESC')
        ->get();
		    // $eptparticipant = Registerept::with(['eptparticipant', 'ept'])->where('deleted_at', NULL)->get();
        // dd($adminuser);
        $page ='eptparticipant';
        return view('isept.adminept.eptparticipant')->with([
			       'eptparticipant'    	=> $eptparticipant,
             'page'               => $page,
        ]);
    }

    public function allparticipant(){
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
        ->get();
		    // $eptparticipant = Registerept::with(['eptparticipant', 'ept'])->where('deleted_at', NULL)->get();
        // dd($adminuser);
        $page ='findparticipant';
        return view('isept.adminept.eptparticipant')->with([
			       'eptparticipant'    	=> $eptparticipant,
             'page'               => $page,
        ]);
    }

    public function findparticipant(){
      $type = Type::where('deleted_at', NULL)->get();
      $page ='findparticipant';
      return view('isept.adminept.findeptparticipant', compact(['type','page']));
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

    public function findparticipantselectcustomdate(Request $req){
        $searchtype = $req->ept_type;
        $searchdateint1 = date('Y-m-d', strtotime($req->ept_dateint1));
        $searchdateint2 = date('Y-m-d', strtotime($req->ept_dateint2));
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
        ->whereBetween('ept_.ept_date', [$searchdateint1, $searchdateint2])
        ->get();

        // dd($eptparticipant);

        $page ='findparticipant';
        return view('isept.adminept.eptparticipant', compact(['page', 'searchdateint1', 'searchdateint2', 'searchtype', 'eptparticipant']));
    }

    public function postEdit(Request $req){
  		$this->validate($req, [
  			'status'                 => 'required|string',
		]);
      if($req->status == 'Unverified'){
        $update         = Registerept::where('id', $req->id_reg)->first();

        if ($update->eptparticipant->profile_picture != 'default.png') {
          $photo              = Storage::disk('eptparticipant_photoprofile')->delete($update->eptparticipant->profile_picture);
        }
        if ($req->statusreg == 'Verified'){
          // $updateRoom = Availableseat::where('id', $update->id_availableseat)->first();
          // $updateRoom->available  = $updateRoom->available+1;
          // $updateRoom->isfull     = 0;
          // $updateRoom->save();
          $qr_codeparticipant = Storage::disk('qr-code_participant')->delete($update->qr_code);
        }
        if ($req->statusreg == 'Abandoned'){
          $updateRoom = Availableseat::where('id', $update->id_availableseat)->first();
          $updateRoom->available  = $updateRoom->available-1;
          $updateRoom->save();
          $qr_codeparticipant = Storage::disk('qr-code_participant')->delete($update->qr_code);
        }

        $update->status = "Unverified";
        $update->save();
      }
      elseif($req->status == 'Abandoned'){
        $data               = Registerept::where('id', $req->id_reg)->first();
        if ($data->eptparticipant->profile_picture != 'default.png') {
        $photo              = Storage::disk('eptparticipant_photoprofile')->delete($data->eptparticipant->profile_picture);
        }
        // $updateRoom = Availableseat::where('id', $data->id_availableseat)->first();
        // $updateRoom->available  = $updateRoom->available+1;
        // $updateRoom->isfull     = 0;
        // $updateRoom->save();
        $qr_codeparticipant = Storage::disk('qr-code_participant')->delete($data->qr_code);
        $update             = Eptparticipant::where('id', $data->id_eptparticipant)->first();
        $totalAbandoned     = Registerept::where('id_eptparticipant', $data->id_eptparticipant)->where('status', 'Abandoned')->count();
        $totalAbandoned++;
        if($totalAbandoned >= 3)
        {
          $update->userstatus = 'Nonactive';
        }
        // for($totalabandoned = 0;$totalabandoned<=($num_cols * $num_rows))
        // {
        //     $totalabandoned = $totalabandoned+1;
        // }

        $total_attempt          = $data->attempt - 1;
        $dataUpdate             = Registerept::where('id', $req->id_reg)->first();
        $dataUpdate->status     = 'Abandoned';
        $dataUpdate->attempt    = $total_attempt;
        $dataUpdate->save();

        $update->profile_picture = 'default.png';
        $update->save();
      }

      else{
        $update = Registerept::where('id', $req->id_reg)->update([
            'status'                     => $req->status,
        ]);
      }
      if ($update) {
        return Redirect::to('isept/adminept/neweptparticipant')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change Data");
      }
    }

    public function edit($id){
        $faculty = Faculty::where('deleted_at', NULL)->get();
		    $type    = Type::where('deleted_at', NULL)->get();
        $edit    = Registerept::with(['eptparticipant', 'ept'])->where('id', $id)->first();

        // dd($adminuser);
        $page ='eptparticipant';
        return view('isept.adminept.editeptparticipant')->with([
            'faculty'               => $faculty,
            'type'                  => $type,
			      'edit'       		        => $edit,
            'page'                  => $page,
        ]);

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

        $updateUser = User::select('name')->where('id', Auth::id())->first();
        $updateUser->name = $req->name;
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

        if ($req->ept_type == 1) {
            $code = 'LCUNILA'.'-'.$this->student.'-'.date('m-d-Y', strtotime($req->ept_date)).'-'.$participant->idnumber_eptparticipant;
        }
        else {
            $code = 'LCUNILA'.'-'.$this->public.'-'.date('m-d-Y', strtotime($req->ept_date)).'-'.$participant->idnumber_eptparticipant;
        }

        $check      = Registerept::where('code', $code)->orderBy('created_at', 'DESC')->first();

        if (!empty($check)) {
            return back()->with('warning', 'Dia sudah Register untuk tanggal ini sebelumnya!');
        }
        else{
            $attempt    = Registerept::select('attempt')->where('id_eptparticipant', $participant->id)->orderBy('created_at', 'DESC')->first();
            $qr_code    = $code.'.png';
            $qr         = QrCode::format('png')->size(200)->margin(0)->generate($code);
            Storage::disk('qr-code')->put($qr_code, $qr);

            if(empty($attempt)){
                $total_attempt = 1;
            }
            else{
                $total_attempt = $attempt->attempt + 1;
            }

            $register = Registerept::create([
                'id_eptparticipant' => $participant->id,
                'id_ept'            => $req->id_ept,
                'code'              => $code,
                'qr_code'           => $qr_code,
                'attempt'           => $total_attempt,
            ]);
        }

        return back()->with('success', 'Berhasil Mendaftar EPT');
    }

    public function searchMajor(Request $req){
        $major = Major::where('id_faculty', $req->val)->get();

        return response()->json($major);
    }

    public function getPictureProfile($name){
        $photo = Storage::disk('eptparticipant_photoprofile')->get($name);

        return $photo;
    }

    public function getQrcodeParticipant($name){
        $qr_codeparticipant = Storage::disk('qr-code_participant')->get($name);

        return $qr_codeparticipant;
    }

    public function abandoned($id){
        $data               = Registerept::where('id', $id)->first();
        if ($data->eptparticipant->profile_picture != 'default.png') {
        $photo              = Storage::disk('eptparticipant_photoprofile')->delete($data->eptparticipant->profile_picture);
        }
        // $updateRoom = Availableseat::where('id', $data->id_availableseat)->first();
        // $updateRoom->available  = $updateRoom->available+1;
        // $updateRoom->isfull     = 0;
        // $updateRoom->save();
        $qr_codeparticipant = Storage::disk('qr-code_participant')->delete($data->qr_code);
        $update             = Eptparticipant::where('id', $data->id_eptparticipant)->first();
        $totalAbandoned     = Registerept::where('id_eptparticipant', $data->id_eptparticipant)->where('status', 'Abandoned')->count();
        $totalAbandoned++;
        if($totalAbandoned >= 3)
        {
          $update->userstatus = 'Nonactive';
        }
        // for($totalabandoned = 0;$totalabandoned<=($num_cols * $num_rows))
        // {
        //     $totalabandoned = $totalabandoned+1;
        // }

        $update->profile_picture = 'default.png';
        $update->save();

        $total_attempt          = $data->attempt - 1;
        $dataUpdate             = Registerept::where('id', $id)->first();
        $dataUpdate->status     = 'Abandoned';
        $dataUpdate->attempt    = $total_attempt;
        $dataUpdate->save();

        return back()->with('success', 'Status Data was changed to Abandoned');
    }

    public function verify($id){
        $update         = Registerept::where('id', $id)->first();

        $start_of_month = Carbon::createFromFormat("Y-m-d", $update->ept->ept_date)->startOfMonth();
        $end_of_month   = Carbon::createFromFormat("Y-m-d", $update->ept->ept_date)->endOfMonth();

        $check          = Ept::select('id')->whereBetween('ept_date', [$start_of_month, $end_of_month])->where('id_epttype', $update->ept->id_epttype)->pluck('id')->toArray();
        $getLatestCode  = Registerept::select('code')->whereIn('id_ept', $check)->whereNotNull('code')->orderBy('code', 'DESC')->first();
        // dd($check);
        // dd($getLatestCode);

        if (empty($getLatestCode)) {
          $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code;
            // $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code.$update->ept->code_ept->code;
        }else{
          $nomor  = substr($getLatestCode->code, 0, 4);
          $x      = intval(str_replace('0', '', $nomor));
          $code   = sprintf('%04d', $x+1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code;
          // dd($code);
        }
        $update->code = $code;
        $update->qr_code = str_replace('/', '-', $code).'.png';
        $qr         = QrCode::format('png')->size(200)->margin(0)->generate(str_replace('/', '-', $code));
        Storage::disk('qr-code_participant')->put($update->qr_code, $qr);
        $update->status = "Verified";
        $update->save();

    		return back()->with('success', "Status Data was changed to Verified");
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

    public function changeStatus(Request $req){
      $this->validate($req, [
        'reg_id'      => 'required',
        'type_status' => 'required',
      ]);

      foreach ($req->reg_id as $key => $value) {
        if ($req->type_status == "Abandoned") {
          $data               = Registerept::where('id', $value)->first();
          if ($data->eptparticipant->profile_picture != 'default.png') {
          $photo              = Storage::disk('eptparticipant_photoprofile')->delete($data->eptparticipant->profile_picture);
          }
          $qr_codeparticipant = Storage::disk('qr-code_participant')->delete($data->qr_code);

          $update             = Eptparticipant::where('id', $data->id_eptparticipant)->first();
          $totalAbandoned     = Registerept::where('id_eptparticipant', $data->id_eptparticipant)->where('status', 'Abandoned')->count();
          $totalAbandoned++;
          if($totalAbandoned >= 3)
          {
            $update->userstatus = 'Nonactive';
          }
          $update->profile_picture = 'default.png';
          $update->save();

          $total_attempt = $data->attempt - 1;
          $dataUpdate         = Registerept::where('id', $value)->first();
          $dataUpdate->status = $req->type_status;
          $dataUpdate->attempt = $total_attempt;
          $dataUpdate->save();
        }

        elseif($req->type_status == "Verified"){
          $update         = Registerept::where('id', $value)->first();

          $start_of_month = Carbon::createFromFormat("Y-m-d", $update->ept->ept_date)->startOfMonth();
          $end_of_month   = Carbon::createFromFormat("Y-m-d", $update->ept->ept_date)->endOfMonth();

          $check          = Ept::select('id')->whereBetween('ept_date', [$start_of_month, $end_of_month])->where('id_epttype', $update->ept->id_epttype)->pluck('id')->toArray();
          $getLatestCode  = Registerept::select('code')->whereIn('id_ept', $check)->whereNotNull('code')->orderBy('code', 'DESC')->first();

          // dd($getLatestCode);

          if (empty($getLatestCode)) {
            $code   = sprintf('%04d', 1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code;
          }else{
            $nomor  = substr($getLatestCode->code, 0, 4);
            $x      = intval(str_replace('0', '', $nomor));
            $code   = sprintf('%04d', $x+1).'-'.date('m', strtotime($update->ept->ept_date)).'.'.$update->ept->type->code;
          }

          $update->code = $code;
          $update->qr_code = str_replace('/', '-', $code).'.png';
          $qr         = QrCode::format('png')->size(200)->margin(0)->generate(str_replace('/', '-', $code));
          Storage::disk('qr-code_participant')->put($update->qr_code, $qr);
          $update->status = $req->type_status;
          $update->save();
        }

      }

      if ($req->type_status == "Abandoned") {
        return back()->with('success', "Status Data was changed to Abandoned");
      }
      else{
        return back()->with('success', "Status Data was changed to Verified");
      }
    }
}
