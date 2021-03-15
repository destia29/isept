<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Role;
use App\Http\Requests;
use Storage;
use Auth;

class ISCLUnilaController extends Controller
{
    public function login()
    {
      if (Auth::check()) {
        return redirect()->route('allhome')->with('warning', "You already login");
      }
      $page ='login';
    	return view('isclunila.login', compact('page'));
    }

    public function signup()
    {
      $page ='signup';
    	return view('isclunila.signup', compact('page'));
    }

    public function forgotpassword()
    {
      $page ='forgotpassword';
    	return view('isclunila.forgotpassword', compact('page'));
    }

    public function homepage()
    {
      $page ='index';
    	return view('isclunila.adminclu.index', compact('page'));
    }

    public function adminaccountlist()
    {
      $page ='adminaccountlist';
    	return view('isclunila.adminclu.adminaccountlist', compact('page'));
    }

    public function addnewadminaccount()
    {
        $role = Role::whereNotIn('id', [1,7])->where('deleted_at', NULL)->get();
        $page ='addnewadminaccount';
    	return view('isclunila.adminclu.addnewadminaccount')->with([
            'page' => $page,
            'role'  => $role,
        ]);
    }

    public function lcuannouncementlist()
    {
      $page ='lcuannouncementlist';
    	return view('isclunila.adminclu.lcuannouncementlist', compact('page'));
    }

    public function addnewannouncement()
    {
      $page ='addnewannouncement';
    	return view('isclunila.adminclu.addnewannouncement', compact('page'));
    }

    public function lcueventlist()
    {
      $page ='lcueventlist';
    	return view('isclunila.adminclu.lcueventlist', compact('page'));
    }

    public function addnewevent()
    {
      $page ='addnewevent';
    	return view('isclunila.adminclu.addnewevent', compact('page'));
    }

    public function eptscore()
    {
      $page ='eptscore';
    	return view('isclunila.adminclu.eptscore', compact('page'));
    }

    public function supportcenter()
    {
      $page ='supportcenter';
    	return view('isclunila.adminclu.supportcenter', compact('page'));
    }

    public function supportcenterchiefoftheboard()
    {
      $page ='supportcenter';
    	return view('isclunila.chiefoftheboard.supportcenter', compact('page'));
    }

    public function addnewlcuservice()
    {
      $page ='lcuservice';
    	return view('isclunila.adminclu.addnewlcuservice', compact('page'));
    }

    public function addneweptparticipant()
    {
      $page ='eptparticipant';
    	return view('isclunila.adminclu.addneweptparticipant', compact('page'));
    }

    public function addnewlcustaff()
    {
      $page ='lcustaff';
    	return view('isclunila.adminclu.addnewlcustaff', compact('page'));
    }

    public function getAdminUserPictureProfile($name){
        $photo = Storage::disk('adminuser_photoprofile')->get($name);

        return $photo;
    }

    public function myprofile()
    {
      $page ='myprofile';
    	return view('isclunila.myprofile', compact('page'));
    }

    public function changepassword()
    {
      $page ='changepassword';
    	return view('isclunila.changepassword', compact('page'));
    }
}
