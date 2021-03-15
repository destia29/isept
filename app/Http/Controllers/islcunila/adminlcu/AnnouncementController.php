<?php

namespace App\Http\Controllers\islcunila\adminlcu;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Announcement;
use App\Model\Ept;
use Redirect;
use Storage;
use Auth;

class AnnouncementController extends Controller
{
  public function index(){
		$announcement = Announcement::with(['user'])->get();
    // dd($announcement);
    $page ='lcuannouncementlist';
    return view('isclunila.adminclu.lcuannouncementlist')->with([
	       'announcement'		       => $announcement,
         'page'                  => $page,
    ]);
	}

	public function postAdd(Request $req){
		$this->validate($req, [
			'title'		               => 'required|string|max:100',
			'description'            => 'required|string',
			'release_date'		       => 'required|string|max:100',
			'input_tags'		         => 'required|string|max:100',
      'announcement_thumbnail' => 'image|max:1024',
		]);

    $file=$req->announcement_thumbnail;
		$nameRaw=$file->getClientOriginalName();
		$filename=mt_rand(100, 999).'-'.$nameRaw;
		Storage::disk('announcement_thumbnail')->put($filename, file_get_contents($file));


		$input = Announcement::create([
            'title'         => $req->title,
            'description'   => $req->description,
            'release_date'  => date('Y-m-d', strtotime($req->release_date)),
            'tag'           => $req->input_tags,
            'thumbnail'     => $filename,
            'id_user'       => Auth::id(),
        ]);

    if ($input) {
      return Redirect::to('isclunila/adminclu/lcuannouncementlist')->with('success', "Data Has been added to Database");
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


        if ($req->announcement_thumbnail) {
           Storage::disk('announcement_thumbnail')->delete($req->announcement_picture_name);
        }

        if ($req->announcement_thumbnail) {
            $file=$req->announcement_thumbnail;
        		$nameRaw=$file->getClientOriginalName();
        		$announcement_picture_name=mt_rand(10000, 99999).'-'.$nameRaw;
        		Storage::disk('announcement_thumbnail')->put($announcement_picture_name, file_get_contents($file));
            }
        else{
            $announcement_picture_name = $req->announcement_picture_name;
        }

		    $update = Announcement::find($req->id_announcement)->update([
            'title'          => $req->title,
            'description'    => $req->description,
            'release_date'   => date('Y-m-d', strtotime($req->release_date)),
            'tag'            => $req->input_tags,
            'thumbnail'      => $announcement_picture_name,
        ]);

    if ($update) {
      return Redirect::to('isclunila/adminclu/lcuannouncementlist')->with('success', "Data Has been changed");
    }
    else{
      return back()->with('danger', "Failed change Data");
    }
  }

    public function edit($id){
        $edit = Announcement::where('id', $id)->first();

        // dd($adminuser);
        $page ='lcuannouncementlist';
        return view('isclunila.adminclu.editannouncement')->with([
			      'edit'    		        => $edit,
            'page'                => $page,
        ]);
    }

    public function delete($id){
        $data  = Announcement::where('id', $id)->first();
        $photo = Storage::disk('announcement_thumbnail')->delete($data->thumbnail);
        $data->forceDelete();

        return back()->with('success', 'Data was successfully deleted');
    }


}
