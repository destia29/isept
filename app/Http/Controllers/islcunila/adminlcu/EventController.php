<?php

namespace App\Http\Controllers\islcunila\adminlcu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Event;
use Redirect;
use Storage;
use Auth;

class EventController extends Controller
{
  public function index(){
		$event = Event::with(['user'])->get();
        // dd($event);
        $page ='lcueventlist';
        return view('isclunila.adminclu.lcueventlist')->with([
			      'event'  				=> $event,
            'page'                  => $page,
        ]);
	}

	public function postAdd(Request $req){
		$this->validate($req, [
			'title'		               => 'required|string|max:100',
			'description'            => 'required|string',
			'release_date'		       => 'required|string|max:100',
			'input_tags'		         => 'required|string|max:100',
      'event_thumbnail'        => 'image|max:1024',
		]);

    $file=$req->event_thumbnail;
		$nameRaw=$file->getClientOriginalName();
		$filename=mt_rand(100, 999).'-'.$nameRaw;
		Storage::disk('event_thumbnail')->put($filename, file_get_contents($file));


		$input = Event::create([
            'title'         => $req->title,
            'description'   => $req->description,
            'release_date'  => date('Y-m-d', strtotime($req->release_date)),
            'tag'           => $req->input_tags,
            'thumbnail'     => $filename,
            'id_user'       => Auth::id(),
        ]);

      if ($input) {
        return Redirect::to('isclunila/adminclu/lcueventlist')->with('success', "Data Has been added to Database");
      }
      else{
        return back()->with('danger', "Failed insert new Data to Database");
      }
	}


  	public function postEdit(Request $req){
  		$this->validate($req, [
        'title'		        => 'required|string',
  			'description'     => 'required|string',
  			'release_date'		=> 'required|string|max:100',
  			'input_tags'		  => 'required|string|max:100',
  		]);


          if ($req->event_thumbnail) {
             Storage::disk('event_thumbnail')->delete($req->event_picture_name);
          }

          if ($req->event_thumbnail) {
              $file=$req->event_thumbnail;
      		$nameRaw=$file->getClientOriginalName();
      		$event_picture_name=mt_rand(10000, 99999).'-'.$nameRaw;
      		Storage::disk('event_thumbnail')->put($event_picture_name, file_get_contents($file));
          }
          else{
              $event_picture_name = $req->event_picture_name;
          }

  		$update = Event::find($req->id_event)->update([
              'title'          => $req->title,
              'description'    => $req->description,
              'release_date'   => date('Y-m-d', strtotime($req->release_date)),
              'tag'            => $req->input_tags,
              'thumbnail'      => $event_picture_name,
          ]);

      if ($update) {
        return Redirect::to('isclunila/adminclu/lcueventlist')->with('success', "Data Has been changed");
      }
      else{
        return back()->with('danger', "Failed change Data");
      }
    }

    public function edit($id){
        $edit = Event::where('id', $id)->first();

        // dd($adminuser);
        $page ='lcueventlist';
        return view('isclunila.adminclu.editevent')->with([
			'edit'    		        => $edit,
            'page'                  => $page,
        ]);
    }

    public function delete($id){
        $data = Event::where('id', $id)->first();
        $photo = Storage::disk('event_thumbnail')->delete($data->thumbnail);
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }
}
