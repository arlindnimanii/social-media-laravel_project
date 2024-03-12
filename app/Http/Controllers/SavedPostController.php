<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    function index() {
        return view('saved-posts');
    }
}
