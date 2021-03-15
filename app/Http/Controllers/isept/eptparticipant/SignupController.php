<?php

namespace App\Http\Controllers\isept\eptparticipant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Eptparticipant;
use Auth;
use Redirect;

class SignupController extends Controller
{
    public function postAdd(Request $req){
      $this->validate($req, [
        'idnumber_eptparticipant'		 => 'required|string|unique:eptparticipant',
        'email'                      => 'required|string',
        'username'                   => 'required|string|unique:users',
        'password'                   => 'required|string|confirmed',
      ]);

      $insert = User::create([
          'id_role'                      => 7,
          'email'                        => $req->email,
          'username'                     => $req->username,
          'password'                     => bcrypt($req->password),
      ]);

      $input = Eptparticipant::create([
          'id_user'                      => $insert->id,
          'idnumber_eptparticipant'      => $req->idnumber_eptparticipant,
      ]);

      if ($input) {
        return Redirect::to('isept/login')->with('success', "You have successfully registered");
      }
      else{
        return back()->with('danger', "Failed insert new Data to Database");
      }
    }
}
