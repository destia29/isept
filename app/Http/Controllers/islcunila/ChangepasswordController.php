<?php

namespace App\Http\Controllers\islcunila;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Registerept;
use App\Model\Adminuser;
use App\Model\Eptparticipant;
use App\Model\Faculty;
use App\Model\Major;
use App\Model\Ept;
use App\Model\Score;
use Auth;
use Hash;

class ChangepasswordController extends Controller
{
    public function index(){
        $user = User::where('id_user', Auth::id())->first();
        // dd($registerept);
        $page ='changepassword';
        return view('isclunila.changepassword')->with([
            'page'           => $page,
            'user'           => $user,
        ]);
	}

    public function postEdit(Request $req){
        $this->validate($req, [
            'currentpassword'      => 'required|string',
            'newpassword'          => 'required|string|confirmed',
		]);
        $user = User::find($req->id_user);
        if (!Hash::check($req->currentpassword, $user->password)) {
            return back()->with('danger', "Current Password Incorrect");
        }

        $user->password = bcrypt($req->newpassword);
        $user->save();

        return back()->with('success', "Data Has been updated");
    }
}
