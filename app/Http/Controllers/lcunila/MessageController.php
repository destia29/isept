<?php

namespace App\Http\Controllers\Lcunila;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Message;

class MessageController extends Controller
{
    public function postCreate(Request $req){
        $this->validate($req, [
            'name'		          => 'required|string|max:40',
            'email'             => 'required|string',
            'subject'           => 'required|string',
            'message'           => 'required|string',
        ]);

		$input = Message::create([
            'name'               => $req->name,
            'email'              => $req->email,
            'subject'            => $req->subject,
            'message'            => $req->message,
        ]);

        if ($input) {
            return back()->with('messagesent', "Your message has been successfully sent. We will send you a reply as soon as possible.");
        }
        else{
            return back()->with('danger', "Failed send new Message");
        }
    }
}
