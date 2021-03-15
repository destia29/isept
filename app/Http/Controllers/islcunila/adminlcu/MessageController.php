<?php

namespace App\Http\Controllers\islcunila\adminlcu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Message;

class MessageController extends Controller
{
    public function index(){
      $lcmessage = Message::where('deleted_at', NULL)->orderBy('id', 'desc')->get();
      // dd($announcement);
      $page ='lcumessage';
      return view('isclunila.adminclu.lcumessagelist')->with([
           'lcmessage'		         => $lcmessage,
           'page'                  => $page,
      ]);
    }

    public function detail($id){
        $detail = Message::where('id', $id)->first();
        $update = Message::where('id', $id)->update([
          'status'          => 'Read',
        ]);

        // dd($adminuser);
        $page ='lcumessage';
        return view('isclunila.adminclu.detaillcumessage')->with([
			      'detail'    		        => $detail,
            'page'                  => $page,
        ]);
    }

    public function delete($id){
        $data = Message::where('id', $id)->first();
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }
}
