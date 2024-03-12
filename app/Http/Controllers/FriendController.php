<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    function getUsers() {
        return DB::table('users')                 
        ->select('*')
        ->whereNotIn('id', DB::table('friends')->select('user_id')->where('user_id', auth()->id())->orWhere('friend_id', auth()->id())->get()->pluck('user_id')->toArray())
        ->whereNotIn('id', DB::table('friends')->select('friend_id')->where('user_id', auth()->id())->orWhere('friend_id', auth()->id())->get()->pluck('friend_id')->toArray())
        ->get();
    }

    function index() {
        $friends = Friend::where('friend_id', auth()->id())->orWhere('user_id', auth()->id())->get();
        $users = $this->getUsers();
        
        return view('friends', [
            'friends' => $friends,
            'users' => $users
        ]);
    }

    function accept($id) {
        $friend = Friend::where('user_id', $id)->where('status', 0)->first();
        $friend->status = 1;
        $friend->save();

        return redirect()->route('friends');
    }

    function unfriend($id) {
        $friend = Friend::where('friend_id', $id)->first();
        $friend->delete();

        return redirect()->route('friends');
    }

    function sendFriendRequest($id) {
        Friend::create([
            'user_id' => auth()->id(),
            'friend_id' => $id
        ]);

        return redirect()->route('friends')->with('status', 'Request was sent successfully.');
    }
}
