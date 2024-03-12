<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use App\Models\Message;
use App\Mail\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    function getSenders() {
        $messages = Message::where('sender_id', auth()->id())->orWhere('receiver_id', auth()->id())->get();
        $ids = [];

        foreach($messages as $message) {
            $ids[] = $message->sender_id;
            $ids[] = $message->receiver_id;
        }

        return array_unique($ids);
    }   

    function index() {
        $user_id = auth()->id(); 
        $users = User::whereIn('id', $this->getSenders())->get();
        $friends = Friend::where('friend_id', auth()->id())->orWhere('user_id', auth()->id())->get();

        return view('messages', [
            'users' => $users,
            'friends' => $friends
        ]);
    }

    function sendMessage(Request $request) {
        $this->validate($request, [
            'message' => 'required|min:2'
        ]);

        if(isset($request->sender_id) && ($request->sender_id > 0)) {
            Message::create(['sender_id' => $request->sender_id, 'receiver_id' => auth()->id(), 'message' => $request->message]);
        }

        if(isset($request->receiver_id) && ($request->receiver_id > 0)) {
            Message::create(['sender_id' => auth()->id(), 'receiver_id' => $request->receiver_id, 'message' => $request->message]);

            // Notify by email
            //$user = User::where('id', $request->receiver_id)->first();
            //Mail::to($user->email)->send(new NewMessage());
        }

        return redirect()->back();
    }

    function deleteMessage($sender_id) {
        $receiver_id = auth()->id();
        $messages = Message::get();

        foreach($messages as $message) {
            if( 
            (($message->sender_id == $sender_id) && ($message->receiver_id == $receiver_id)) 
            ||
            (($message->sender_id == $receiver_id) && ($message->receiver_id == $sender_id))
            ) {
                $message->delete();
            }
        }

        return redirect()->route('messages');
    }

    // function getSenders() {
    //     $senders = [];
    //     $results = DB::table('messages')->distinct()->where('receiver_id', auth()->id())->where('sender_id', '!=', auth()->id())->get(['sender_id'])->toArray();

    //     foreach($results as $r) {
    //         $senders[] = $r->sender_id;
    //     }

    //     return $senders;
    // }  
}
