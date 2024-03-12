<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index() {
        $setting = auth()->user()->settings()->first();

        if(!is_null($setting)) return view('settings', ['setting' => $setting]);

        return view('settings');
    }

    function saveSettings(Request $request) {
        $this->validate($request, [
            'allow_friend_requests' => 'required',
            'nr_posts_in_homepage' => 'required|numeric',
        ]);

        $settings = Setting::where('user_id', auth()->id())->first();

        if(is_null($settings)) {
            $settings = new Setting;
        }

        $settings->user_id = auth()->id();
        $settings->allow_friend_requests = isset($request->allow_friend_requests) ? 1 : 0;
        $settings->nr_posts_in_homepage = $request->nr_posts_in_homepage;

        if($settings->save()) {
            return redirect()->back()->with('status', 'Settings were saved successfully.');
        }

        return redirect()->back()->with('status', 'Something want wrong!');
    }
}
