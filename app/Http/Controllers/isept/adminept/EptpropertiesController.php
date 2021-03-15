<?php

namespace App\Http\Controllers\isept\adminept;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Type;
use App\Model\Room;
use App\Model\Code;
use Redirect;

class EptpropertiesController extends Controller
{
    public function index(){
        $typeproperties = Type::where('deleted_at', NULL)->get();
        $roomproperties = Room::where('deleted_at', NULL)->get();
        $codeproperties = Code::where('deleted_at', NULL)->get();
        $page ='eptproperties';
        return view('isept.adminept.eptproperties')->with([
			      'typeproperties'    		    => $typeproperties,
			      'roomproperties'    		    => $roomproperties,
			      'codeproperties'    		    => $codeproperties,
            'page'                      => $page,
        ]);
    }

  	public function postAddnewtype(Request $req){
  		$this->validate($req, [
          'code'          => 'required|integer|unique:epttype',
          'type'          => 'required|string',
          'cost'          => 'required|integer',
  		]);

      $insert = Type::create([
          'code'          => $req->code,
          'type'          => $req->type,
          'cost'          => $req->cost,
      ]);

  		if ($insert) {
        return Redirect::to('isept/adminept/eptproperties')->with('success', "Data Has been added to Database");
  		}
  		else{
  			return back()->with('danger', "Failed insert new Data to Database");
  		}
  	}

    public function postEdittype(Request $req){
        $this->validate($req, [
            'code'          => 'required|integer',
            'type'          => 'required|string',
            'cost'          => 'required|integer',
		]);

        $checkCode = Type::where('code', $req->code)->where('id', '!=', $req->id_epttype)->first();

        if (!empty($checkCode)) {
          return back()->with('warning', "Code has already taken");
        }

        $update = Type::find($req->id_epttype)->update([
            'code'          => $req->code,
            'type'          => $req->type,
            'cost'          => $req->cost,
        ]);

  		if ($update) {
        return Redirect::to('isept/adminept/eptproperties')->with('success', "Data Has been canged");
  		}
  		else{
  			return back()->with('danger', "Failed change Data");
  		}
    }

    public function edittype($id){
        $edit = Type::where('id', $id)->first();

        // dd($adminuser);
        $page ='eptproperties';
        return view('isept.adminept.editepttype')->with([
			      'edit'    		        => $edit,
            'page'                => $page,
        ]);
    }

    public function deletetype($id){
        $data = Type::where('id', $id)->first();
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }

  	public function postAddnewroom(Request $req){
  		$this->validate($req, [
          'room_name'     => 'required|string',
          'capacity'      => 'required|integer',
  		]);

      $insert = Room::create([
          'room_name'         => $req->room_name,
          'capacity'          => $req->capacity,
      ]);

  		if ($insert) {
        return Redirect::to('isept/adminept/eptproperties')->with('success', "Data Has been added to Database");
  		}
  		else{
  			return back()->with('danger', "Failed insert new Data to Database");
  		}
  	}

    public function postEditroom(Request $req){
        $this->validate($req, [
            'room_name'         => 'required|string',
            'capacity'          => 'required|integer',
		]);

        $update = Room::find($req->id_eptroom)->update([
            'room_name'         => $req->room_name,
            'capacity'          => $req->capacity,
        ]);

  		if ($update) {
        return Redirect::to('isept/adminept/eptproperties')->with('success', "Data Has been changed");
  		}
  		else{
  			return back()->with('danger', "Failed change Data");
  		}
    }

    public function editroom($id){
        $edit = Room::where('id', $id)->first();

        // dd($adminuser);
        $page ='eptproperties';
        return view('isept.adminept.editeptroom')->with([
			      'edit'    		        => $edit,
            'page'                => $page,
        ]);
    }

    public function deleteroom($id){
        $data = Room::where('id', $id)->first();
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }

  	public function postAddnewcode(Request $req){
  		$this->validate($req, [
          'code'     => 'required|string',
  		]);

      $insert = Code::create([
          'code'         => $req->code,
      ]);

  		if ($insert) {
        return Redirect::to('isept/adminept/eptproperties')->with('success', "Data Has been added to Database");
  		}
  		else{
  			return back()->with('danger', "Failed insert new Data to Database");
  		}
  	}

    public function postEditcode(Request $req){
        $this->validate($req, [
            'code'         => 'required|string',
		]);

        $update = Code::find($req->id_eptcode)->update([
            'code'         => $req->code,
        ]);

  		if ($update) {
        return Redirect::to('isept/adminept/eptproperties')->with('success', "Data Has been changed");
  		}
  		else{
  			return back()->with('danger', "Failed change Data");
  		}
    }

    public function editcode($id){
        $edit = Code::where('id', $id)->first();

        // dd($adminuser);
        $page ='eptproperties';
        return view('isept.adminept.editeptcode')->with([
			      'edit'    		        => $edit,
            'page'                => $page,
        ]);
    }

    public function deletecode($id){
        $data = Code::where('id', $id)->first();
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }
}
