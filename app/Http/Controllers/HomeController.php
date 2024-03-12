<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $take = auth()->user()->settings()->first();
        $take = (!is_null($take)) ? $take->nr_posts_in_homepage : 12;

        $posts = Post::take($take)->get();

        return view('dashboard', [
            'posts' => $posts
        ]);
    }
}
