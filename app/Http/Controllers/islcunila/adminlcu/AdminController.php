<?php

namespace App\Http\Controllers\islcunila\adminlcu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Adminuser;
use App\Model\Role;
use Redirect;
use Storage;
use Auth;

class AdminController extends Controller
{
    public function index(){
		    $adminuser = User::with(['adminuser', 'role'])->whereIn('id_role', [2,3,4,5,6])->get();
        // dd($adminuser);
        $page ='adminaccountlist';
        return view('isclunila.adminclu.adminaccountlist')->with([
			      'adminuser'				=> $adminuser,
            'page'            => $page,
        ]);
	}

	public function postAdd(Request $req){
		$this->validate($req, [
			'name'		          => 'required|string|max:100',
			'email'             => 'required|string|unique:users',
			'nip_user'          => 'required|string|unique:adminuser',
			'username'          => 'required|string|unique:users',
			'password'          => 'required|string|confirmed',
			'admin_type'  		  => 'required',
			'position'  		    => 'required|string',
		]);

        $insert = User::create([
            'id_role'   => $req->admin_type,
            'name'      => $req->name,
            'username'  => $req->username,
            'email'     => $req->email,
            'password'  => bcrypt($req->password),
        ]);

		    $input = Adminuser::create([
            'id_user'       => $insert->id,
            'position'      => $req->position,
            'nip_user'      => $req->nip_user,
        ]);

    if ($input) {
      return Redirect::to('isclunila/adminclu/adminaccountlist')->with('success', "Data Has been added to Database");
    }
    else{
      return back()->with('danger', "Failed insert new Data to Database");
    }
	}

    public function postEdit(Request $req){
        $this->validate($req, [
    			'name'		          => 'required|string|max:100',
    			'email'             => 'required|string',
    			'nip_user'          => 'required|string',
    			'username'          => 'required|string',
    			'password'          => 'required|string|confirmed',
    			'admin_type'  		  => 'required',
    			'position'  		    => 'required|string',
		]);

    $checkUsername = User::where('username', $req->username)->where('id', '!=', $req->id_user)->first();

    if (!empty($checkUsername)) {
      return back()->with('warning', "Username has already taken");
    }
    $checkNipuser = Adminuser::where('nip_user', $req->nip_user)->where('id', '!=', $req->id_adminuser)->first();
    if (!empty($checkNipuser)) {
      return back()->with('warning', "NIP has already taken");
    }
      $update = User::find($req->id_user)->update([
          'id_role'   => $req->admin_type,
          'name'      => $req->name,
          'username'  => $req->username,
          'email'     => $req->email,
          'password'  => bcrypt($req->password),
      ]);

      $update2 = Adminuser::find($req->id_adminuser)->update([
          'position'              => $req->position,
          'nip_user'              => $req->nip_user,
      ]);

      if ($update2) {
        return Redirect::to('isclunila/adminclu/adminaccountlist')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change Data");
      }
    }

    public function edit($id){
        $edit = User::where('id', $id)->first();
    		$role = Role::whereIn('id', [2,3,4,5,6])->get();
        // dd($adminuser);
        $page ='adminaccountlist';
        return view('isclunila.adminclu.editadminaccount')->with([
  			  'edit'    		        => $edit,
          'role'                => $role,
          'page'                => $page,
        ]);
    }

    public function delete($id){
        $data = User::find($id);
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }
}
