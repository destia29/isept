<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Type;
use App\Model\Room;
use App\Model\User;
use App\Model\Code;
use App\Model\Adminuser;
use Storage;
use Auth;

class ISEPTUnilaController extends Controller
{
    public function login()
    {
      if (Auth::check()) {
        return redirect()->route('allhome')->with('warning', "You already login");
      }
      $page ='login';
    	return view('isept.login');
    }

    public function signup()
    {
      $page ='signup';
    	return view('isept.signup', compact('page'));
    }

    public function forgotpassword()
    {
      $page ='forgotpassword';
    	return view('isept.forgotpassword', compact('forgotpassword'));
    }

    public function homepageadminept()
    {
      $page ='index';
    	return view('isept.adminept.index', compact('page'));
    }

    public function eptparticipant()
    {
      $page ='eptparticipant';
      return view('isept.adminept.eptparticipant', compact('page'));
    }

    public function eptschedulelist()
    {
      $page ='eptschedulelist';
      return view('isept.adminept.eptschedulelist', compact('page'));
    }

    public function addneweptschedule()
    {
        $type = Type::where('deleted_at', NULL)->get();
        $room = Room::where('deleted_at', NULL)->get();
        $code = Code::where('id', 1)->first();
        $page ='addneweptschedule';
    	  return view('isept.adminept.addneweptschedule')->with([
            'page'  => $page,
            'type'  => $type,
            'room'  => $room,
            'code'  => $code,
        ]);
    }

    public function addnewepttype()
    {
        $type = Type::where('deleted_at', NULL)->get();
        $page ='addnewepttype';
    	  return view('isept.adminept.addnewepttype')->with([
            'page'  => $page,
            'type'  => $type,
        ]);
    }

    public function addneweptroom()
    {
        $room = Room::where('deleted_at', NULL)->get();
        $page ='addneweptroom';
    	  return view('isept.adminept.addneweptroom')->with([
            'page'  => $page,
            'room'  => $room,
        ]);
    }

    public function supportcenter()
    {
      $page ='supportcenter';
      return view('isept.adminept.supportcenter', compact('page'));
    }


    public function homepageeptvaluemanager()
    {
      $page ='index';
    	return view('isept.eptvaluemanager.index', compact('page'));
    }

    public function eptscoreeptvaluemanager()
    {
      $page ='eptscorelist';
      return view('isept.eptvaluemanager.eptscorelist', compact('page'));
    }

    public function uploadeptscore()
    {
      $page ='uploadeptscore';
      return view('isept.eptvaluemanager.uploadeptscore', compact('page'));
    }

    public function supportcentereptvaluemanager()
    {
      $page ='supportcenter';
      return view('isept.eptvaluemanager.supportcenter', compact('page'));
    }


    public function homepageadmindekanat()
    {
      $page ='index';
    	return view('isept.admindekanat.index', compact('page'));
    }

    public function supportcenteradmindekanat()
    {
      $page ='supportcenter';
      return view('isept.admindekanat.supportcenter', compact('page'));
    }

    public function homepageeptparticipant()
    {
      $page ='index';
    	return view('isept.eptparticipant.index', compact('page'));
    }

    public function supportcentereptparticipant()
    {
      $page ='supportcenter';
      return view('isept.eptparticipant.supportcenter', compact('page'));
    }

    public function eptscoreparticipant()
    {
      $page ='eptscoreparticipant';
      return view('isept.eptparticipant.eptscoreparticipant', compact('page'));
    }

    public function registerept()
    {
      $page ='registerept';
      return view('isept.eptparticipant.registerept', compact('page'));
    }

    public function participantprofile()
    {
      $page ='participantprofile';
      return view('isept.eptparticipant.participantprofile', compact('page'));
    }

    public function getAdminUserPictureProfile($name){
        $photo = Storage::disk('adminuser_photoprofile')->get($name);

        return $photo;
    }

    public function myprofile()
    {
      $page ='myprofile';
      return view('isept.myprofile', compact('page'));
    }

    public function changepassword()
    {
      $page ='changepassword';
      return view('isept.changepassword', compact('page'));
    }

    public function eptscore()
    {
      $page ='eptscore';
      return view('isept.eptscore', compact('page'));
    }

}
