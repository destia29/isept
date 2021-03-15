<?php

namespace App\Http\Controllers\isept\adminept;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Ept;
use App\Model\Type;
use App\Model\Room;
use App\Model\Availableseat;
use Carbon\Carbon;
use Storage;
use Auth;
use QrCode;
use File;
use Response;
use Redirect;
use DB;

class EptscheduleController extends Controller
{
    private $student = 'S1_D3';
    private $public = 'S2_PUBLIC';

    public function index(){
    $ept = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('ept_date', '>=', Carbon::today().' 00:00:00')
    ->orderBy('id', 'DESC')->get();
    $ept_datedeadline = Carbon::today();
    $vardatein1 = 'all';
    // dd($ept);
    $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

    $registered =  Registerept::where('status', "Verified")->get();
        // dd($adminuser);
        $page ='eptschedulelist';
        return view('isept.adminept.eptschedulelist')->with([
			      'ept'    		                => $ept,
            'page'                      => $page,
            'ept_datedeadline'          => $ept_datedeadline,
            'eptverified'               => $eptverified,
            'registered'                => $registered,
            'vardatein1'                => $vardatein1,
        ]);
    }

    public function getRoom(Request $req){
      $date = date('Y-m-d', strtotime($req->date));
      $time = Carbon::createFromFormat('H:i:s', date('H:i:s', strtotime($req->time)));
      // return response($time->addMinutes(119)->toTimeString());
      $checkEpt = Ept::select('id')->where([
        ['ept_date', $date],
        ['id_epttype', $req->ept_type]
      ])
      ->whereBetween('ept_time', [
        $time->subMinutes(119)->toTimeString(),
        $time->addMinutes(238)->toTimeString()
        ])->first();

      if (empty($checkEpt)) {
        $getRoom = Room::whereNull('deleted_at')->get();
      }
      else{
        $checkRoom = Availableseat::where('id_ept', $checkEpt->id)->pluck('id_eptroom')->toArray();
        $getRoom = Room::whereNotIn('id', $checkRoom)->get();
      }

      return response()->json($getRoom);
    }

    public function alleptschedule(){
    $ept = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('deleted_at', NULL)
    ->orderBy('id', 'DESC')->get();
    $ept_datedeadline = Carbon::today();
    $vardatein1 = 'all';
    // dd($ept);
    $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

    $registered =  Registerept::where('status', "Verified")->get();
        // dd($adminuser);
        $page ='findschedule';
        return view('isept.adminept.eptschedulelist')->with([
			      'ept'    		                => $ept,
            'page'                      => $page,
            'eptverified'               => $eptverified,
            'ept_datedeadline'          => $ept_datedeadline,
            'registered'                => $registered,
            'vardatein1'                => $vardatein1,
        ]);
    }

    public function findschedule(){
      $type = Type::where('deleted_at', NULL)->get();
      $page ='findschedule';
      return view('isept.adminept.findeptschedule', compact(['type','page']));
    }

    public function findscheduleselectdate(Request $req){
        $searchtype = $req->ept_type;

        $searchdate = date('Y-m-d', strtotime($req->ept_date));
        $vardate    = date('F j, Y', strtotime($req->ept_date));
        $vardatein1 = NULL;
        // dd($searchdate);
        $ept = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('id_epttype', $searchtype)
        ->where('ept_date', $searchdate)->orderBy('id', 'DESC')->get();
        $ept_datedeadline = Carbon::today();
        // dd($ept);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();

        // dd($eptschedule);

        $page ='findschedule';
        return view('isept.adminept.eptschedulelist', compact(['page', 'searchdate', 'searchtype', 'ept', 'ept_datedeadline', 'eptverified', 'registered', 'vardatein1', 'vardate']));
    }

    public function findscheduleselectcustomdate(Request $req){
        $searchtype     = $req->ept_type;
        $searchdateint1 = date('Y-m-d', strtotime($req->ept_dateint1));
        $searchdateint2 = date('Y-m-d', strtotime($req->ept_dateint2));
        $vardatein1     = date('F j, Y', strtotime($req->ept_dateint1));
        $vardatein2     = date('F j, Y', strtotime($req->ept_dateint2));
        // dd($searchdate);
        $ept = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('id_epttype', $searchtype)
        ->whereBetween('ept_date', [$searchdateint1, $searchdateint2])->orderBy('id', 'DESC')->get();
        $ept_datedeadline = Carbon::today();
        // dd($ept);
        $eptverified = Registerept::whereIn('status', ["Verified", "Done"])->get();

        $registered =  Registerept::where('status', "Verified")->get();
        // dd(date('F j, Y', strtotime($req->ept_dateint1)));
        // dd($eptschedule);

        $page ='findschedule';
        return view('isept.adminept.eptschedulelist', compact(['page', 'searchdateint1', 'searchdateint2', 'searchtype', 'ept', 'ept_datedeadline', 'eptverified', 'registered', 'vardatein1', 'vardatein2']));
    }

	public function postAdd(Request $req){
		$this->validate($req, [
            'test_type'         => 'required',
            'ept_code'          => 'required',
            'ept_date'          => 'required|string',
            'ept_time'          => 'required|string',
            'ept_room'          => 'required',
            'registration_date' => 'required|string',
		]);
        $availabletime = Carbon::createFromFormat('H:i:s', date('H:i:s', strtotime($req->ept_time)));
        if ($req->test_type == 1) {
            $code = 'LCUNILA'.'-'.'EPT_RESULT-'.$this->student.'-'.date('m-d-Y', strtotime($req->ept_date));
        }
        else {
            $code = 'LCUNILA'.'-'.'EPT_RESULT-'.$this->public.'-'.date('m-d-Y', strtotime($req->ept_date));
        }
        $available_eptroom =$req->ept_room;
        // dd($available_eptroom);
        $check1 = DB::table("ept")
                ->join("availableseat", "ept.id", "=", "availableseat.id_ept")
                ->whereIn('availableseat.id_eptroom', $available_eptroom)
                ->where('ept.ept_date', date('Y-m-d', strtotime($req->ept_date)))
                ->whereBetween('ept.ept_time', [
                    $availabletime->subMinutes(119)->toTimeString(),
                    $availabletime->addMinutes(238)->toTimeString()
                ])
                ->where('ept.id_epttype', $req->test_type)->first();
        // dd($check1);
        // $check1      = Ept::where('ept_date', date('Y-m-d', strtotime($req->ept_date)))->first();
        // $check2      = Ept::where('ept_time', date('H:i:s', strtotime($req->ept_time)))->first();
        // $check3      = Ept::where('id_epttype', $req->test_type)->first();
        // // dd($req->ept_room);
        // $available_eptroom =$req->ept_room;
        // // dd($available_eptroom);
        // $check4      = EPT::whereHas('availableseat', function($query) use($available_eptroom){
        //   $query->where('id_eptroom', $available_eptroom);
        // })->first();
        // dd($check4);
        // dd($req->test_type);

        // if (!empty($check1) && !empty($check2) && !empty($check3) && !empty($check4)) {
        //     return back()->with('warning', 'You have already registered EPT Schedule at that time before!');
        // }
        // dd($check1);
        if (!empty($check1) && $check1 != null) {
            return back()->with('warning', 'You have already registered EPT Schedule at that time before!');
        }
        else{
            $qr_code    = $code.'.png';
            $qr         = QrCode::format('png')->size(200)->margin(0)->generate($code);
            Storage::disk('qr-code_ept')->put($qr_code, $qr);

        $insert = Ept::create([
            'id_epttype'        => $req->test_type,
            'id_eptcode'        => 1,
            'ept_date'          => date('Y-m-d', strtotime($req->ept_date)),
            'ept_time'          => $req->ept_time,
            'code'              => $code,
            'qr_code'           => $qr_code,
            'registration_date' => date('Y-m-d', strtotime($req->registration_date)),
        ]);

        foreach ($req->ept_room as $key => $value) {
          $capacity   = Room::select('capacity')->where('id', $value)->first();
          $insertRoom = Availableseat::create([
            'id_ept'      => $insert->id,
            'id_eptroom'  => $value,
            'available'   => $capacity->capacity,
          ]);
        }
      }

      if ($insert) {
        return Redirect::to('isept/adminept/eptschedulelist')->with('success', "Data Has been added to Database");
      }
      else{
        return back()->with('danger', "Failed insert new Data to Database");
      }
    }

    public function postEdit(Request $req){
        $this->validate($req, [
            'test_type'         => 'required',
            'ept_date'          => 'required|string',
            'ept_time'          => 'required|string',
            'registration_date' => 'required|string',
		]);

        $update = Ept::find($req->id_ept)->update([
            'id_epttype'        => $req->test_type,
            'id_eptcode'        => 1,
            'ept_date'          => date('Y-m-d', strtotime($req->ept_date)),
            'ept_time'          => $req->ept_time,
            'registration_date' => date('Y-m-d', strtotime($req->registration_date)),
        ]);

      if ($update) {
        return Redirect::to('isept/adminept/eptschedulelist')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change Data");
      }
    }

    public function edit($id){
        $type = Type::whereNull('deleted_at')->get();
        $edit = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('id', $id)->first();

        // dd($adminuser);
        $page ='eptschedulelist';
        return view('isept.adminept.editeptschedule')->with([
			      'edit'    		        => $edit,
            'type'    		        => $type,
            'page'                => $page,
        ]);
    }

    public function delete($id){
        $data = Ept::where('id', $id)->first();
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }
}
