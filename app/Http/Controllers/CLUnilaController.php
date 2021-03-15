<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Eptparticipant;
use App\Model\Ept;
use App\Model\Type;
use Carbon\Carbon;
use App\Http\Requests;
use App\Model\Service;
use App\Model\Announcement;
use App\Model\Staff;
use App\Model\Event;
use Storage;
use Auth;
use Redirect;
use DB;

class CLUnilaController extends Controller
{
    public function homepage()
    {
      // $now = Carbon::today();
      // $id = Ept::select('id')->where('registration_date', '<', $now->toDateString())->get()->pluck('id')->toArray();
      // $update = Registerept::whereIn('id_ept', $id)->whereNotIn('status', ['Verified', 'Done', 'Abandoned'])->update([
      //   'status' => 'Abandoned'
      // ]);
      //
      // dd($update);
      $lcservice = Service::where('deleted_at', NULL)->count();
      $lceptparticipant = Eptparticipant::where('deleted_at', NULL)->count();
      $lcstaff = Staff::where('deleted_at', NULL)->count();
      $recentannouncement = Announcement::all()->sortByDesc('id')->take(3);
      $recentevent = Event::all()->sortByDesc('id')->take(3);
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      $eptschedules1 = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('registration_date', '>=', Carbon::today().' 00:00:00')
      ->where('id_epttype', 1)->orderBy("ept_date", "DESC")->limit(5)->get();
      $eptschedules2 = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('registration_date', '>=', Carbon::today().' 00:00:00')
      ->where('id_epttype', 2)->orderBy("ept_date", "DESC")->limit(5)->get();
      return view('clunila.index', compact(['lcservice', 'lceptparticipant', 'lcstaff', 'recenteventfooter', 'recentannouncement', 'recentevent', 'eptschedules1', 'eptschedules2']));
    }

    public function searchhome(Request $req){

        $recentannouncement =Announcement::all()->sortByDesc('id')->take(3);
        $recenteventfooter =Event::all()->sortByDesc('id')->take(3);
        $src = $req->searchhome;
        $search = strtolower($req->searchhome);

        $searchhome = Event::where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orderBy('id', 'desc')
        ->paginate(6);

        // dd($adminuser);
        $page ='searchhome';
        return view('clunila.searchhome', compact(['recentannouncement', 'recenteventfooter']))->with([
			      'searchhome'   	        => $searchhome,
            'page'                  => $page,
            'src'                   => $src,
        ]);
    }

    public function contactus()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.contactus', compact(['recenteventfooter']));
    }

    public function announcement()
    {
      $recentannouncement = Announcement::all()->sortByDesc('id')->take(3);
      $announcement = Announcement::orderBy('id', 'desc')->paginate(6);
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.announcement', compact(['announcement','recentannouncement', 'recenteventfooter']));
    }

    public function getAnnouncementPicture($name){
        $photo = Storage::disk('announcement_thumbnail')->get($name);

        return $photo;
    }

    public function detailannouncement($id){
        $recentannouncement = Announcement::all()->sortByDesc('id')->take(3);
        $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
        $detailannouncement = Announcement::where('id', $id)->first();
        $prevpage = $id;
        $nextpage = $id;
        $prevdetail = Announcement::where('id', '<', $id)->orderBy('id', 'DESC')->first();
        $nextdetail = Announcement::where('id', '>', $nextpage)->first();
        $tags = explode(',', $detailannouncement->tag);

        // dd($adminuser);
        $page ='detailannouncement';
        return view('clunila.announcementdetail', compact(['recentannouncement', 'recenteventfooter', 'prevdetail', 'nextdetail']))->with([
			      'detailannouncement'   	=> $detailannouncement,
            'page'                  => $page,
            'prevpage'              => $prevpage,
            'nextpage'              => $nextpage,
            'tags'                  => $tags,
        ]);
    }

    public function searchannouncement(Request $req){

        $recentannouncement = Announcement::all()->sortByDesc('id')->take(3);
        $recenteventfooter = Event::all()->sortByDesc('id')->take(3);

        $search = strtolower($req->searchannouncement);

        $searchannouncement = Announcement::where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orderBy('id', 'desc')
        ->paginate(6);

        // dd($adminuser);
        $page ='searchannouncement';
        return view('clunila.searchannouncement', compact(['recentannouncement', 'recenteventfooter', 'search']))->with([
			      'searchannouncement'   	=> $searchannouncement,
            'page'                  => $page,
        ]);
    }

    public function searchtag(Request $req){

        $recentannouncement = Announcement::all()->sortByDesc('id')->take(3);
        $recenteventfooter = Event::all()->sortByDesc('id')->take(3);

        $search = strtolower($req->searchtag);

        $searchannouncement = Announcement::where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orderBy('id', 'desc')
        ->paginate(6);

        // dd($adminuser);
        $page ='searchannouncement';
        return view('clunila.searchannouncement', compact(['recentannouncement', 'recenteventfooter', 'search']))->with([
			      'searchannouncement'   	=> $searchannouncement,
            'page'                  => $page,
        ]);
    }

    public function event()
    {
      $recentevent = Event::all()->sortByDesc('id')->take(3);
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      $event = Event::orderBy('id', 'desc')->paginate(2);
      return view('clunila.event', compact(['event', 'recentevent', 'recenteventfooter']));
    }

    public function getEventPicture($name){
        $photo = Storage::disk('event_thumbnail')->get($name);

        return $photo;
    }

    public function detailevent($id){
        $recentevent = Event::all()->sortByDesc('id')->take(3);
        $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
        $detailevent = Event::where('id', $id)->first();
        $prevpage = $id;
        $nextpage = $id;
        $prevdetail = Event::where('id', '<', $id)->orderBy('id', 'DESC')->first();
        $nextdetail = Event::where('id', '>', $nextpage)->first();

        // dd($adminuser);
        $page ='detailevent';
        return view('clunila.eventdetail', compact(['recentevent', 'recenteventfooter', 'prevdetail', 'nextdetail']))->with([
			      'detailevent' => $detailevent,
            'page'        => $page,
            'prevpage'    => $prevpage,
            'nextpage'    => $nextpage,
        ]);
    }

    public function searchevent(Request $req){

        $recentevent = Event::all()->sortByDesc('id')->take(3);
        $recenteventfooter = Event::all()->sortByDesc('id')->take(3);

        $search = strtolower($req->searchevent);

        $searchevent = Event::where('title', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orderBy('id', 'desc')
        ->paginate(6);

        // dd($adminuser);
        $page ='searchevent';
        return view('clunila.searchevent', compact(['recentevent', 'recenteventfooter', 'search']))->with([
			      'searchevent'   	      => $searchevent,
            'page'                  => $page,
        ]);
    }

    public function getStaffPictureProfile($name){
        $photo = Storage::disk('staff_photoprofile')->get($name);

        return $photo;
    }

    public function clunilaprofile()
    {
      $staff = Staff::all();
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.clunilaprofile', compact(['staff', 'recenteventfooter']));
    }

    public function ourcommitment()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.ourcommitment', compact(['recenteventfooter']));
    }

    public function ourservice()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      $service = Service::all();
      return view('clunila.ourservice', compact(['service', 'recenteventfooter']));
    }

    public function englishproficiencytest()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      $eptschedules1 = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('registration_date', '>=', Carbon::today().' 00:00:00')
      ->where('id_epttype', 1)->orderBy("ept_date", "DESC")->get();
      $eptschedules2 = Ept::with(['type', 'registerept_registered', 'registerept_participant', 'availableseat'])->where('registration_date', '>=', Carbon::today().' 00:00:00')
      ->where('id_epttype', 2)->orderBy("ept_date", "DESC")->get();
      return view('clunila.englishproficiencytest', compact(['recenteventfooter', 'eptschedules1', 'eptschedules2']));
    }

    public function searcheptresult(Request $req){
        $recenteventfooter = Event::all()->sortByDesc('id')->take(3);

        $search = strtolower($req->searcheptresult);

        $searcheptresult = DB::table('registerept as reg')
        ->select([
          'reg.id as reg_id',
          'reg.status as status',
          'ept_.id as ept_id',
          'ept_room.room_name as room_name',
          'eptpart.id as eptpart_id',
          'eptpart.profile_picture as eptpart_profilepicture',
          'src.listening_score as listening_score',
          'src.structure_score as structure_score',
          'src.reading_score as reading_score',
          'src.total_score as total_score',
          'user.name as user_name',
          'user.email as user_email',
          'ept_type.type as type',
          'ept_.ept_date as ept_eptdate',
          'ept_.ept_time as ept_epttime',
          'ept_.registration_date as ept_registrationdate',
          'eptpart.idnumber_eptparticipant as eptpart_idnumber',
          'faculty.faculty_alias as faculty_alias',
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
        ->where('reg.code', 'like', $search)
        ->orWhere('reg.qr_code', 'like', $search.".png")
        ->first();

        // dd($adminuser);
        $page ='searcheptresult';
        return view('clunila.searcheptresult', compact(['recenteventfooter', 'search']))->with([
            'page'                  => $page,
			      'searcheptresult'   	  => $searcheptresult,
        ]);
    }

    public function toeflitp()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.toeflitp', compact(['recenteventfooter']));
    }

    public function toeic()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.toeic', compact(['recenteventfooter']));
    }

    public function ielts()
    {
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.ielts', compact(['recenteventfooter']));
    }

    public function visionmission()
    {
      $recenteventvissionmission = Event::all()->sortByDesc('id')->take(6);
      $recenteventfooter = Event::all()->sortByDesc('id')->take(3);
      return view('clunila.visionmission', compact(['recenteventfooter', 'recenteventvissionmission']));
    }

    public function iseptlogin()
    {
      return view('clunila.iseptlogin');
    }

    public function isclunilalogin()
    {
      return view('isclunila.login');
    }

    public function getEptQrCode($name){
        $qr_code = Storage::disk('qr-code_ept')->get($name);

        return $qr_code;
    }
}
