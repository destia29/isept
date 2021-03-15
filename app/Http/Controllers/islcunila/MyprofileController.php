<?php

namespace App\Http\Controllers\islcunila;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Adminuser;
use App\Model\Ept;
use Storage;
use Auth;

class MyprofileController extends Controller
{
	public function postEdit(Request $req){
		$this->validate($req, [
            'name'		        	=> 'required|string|max:100',
            'email'             => 'required|string|email',
            'username'          => 'required|string',
            'handphone_number'  => 'required|string',
            'position'  				=> 'required|string',
		]);
        if ($req->adminuser_photoprofile && $req->adminuser_picture_name != 'default.png') {
           Storage::disk('adminuser_photoprofile')->delete($req->adminuser_picture_name);
        }

        if ($req->adminuser_photoprofile) {
            $file=$req->adminuser_photoprofile;
		    		$nameRaw=$file->getClientOriginalName();
		    		$adminuser_picture_name=mt_rand(10000, 99999).'-'.$nameRaw;
		    		Storage::disk('adminuser_photoprofile')->put($adminuser_picture_name, file_get_contents($file));
        }
        else{
            $adminuser_picture_name = $req->adminuser_picture_name;
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

	      $update2 = Adminuser::find($req->id_adminuser)->update([
	          'position'              => $req->position,
	          'handphone_number'      => $req->handphone_number,
	          'profile_picture'       => $adminuser_picture_name,
	      ]);

				if ($update2) {
					return back()->with('success', "Data Has been changed");
				}
				else{
					return back()->with('danger', "Failed change Data");
				}
    }
}
