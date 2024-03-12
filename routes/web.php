<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SavedPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(auth()->guest())
        return view('welcome');
    else 
        return redirect()->route('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::post('/post/create', [PostController::class, 'create'])->name('create-post');
    Route::get('/post/{id}/delete', [PostController::class, 'delete'])->name('delete-post');
    Route::get('/posts/{id}', [PostController::class, 'showPost'])->name('show-post');
    Route::get('/posts/{id}/like', [PostController::class, 'likePost'])->name('like-post');
    Route::post('/posts/{id}/comment', [PostController::class, 'addCommentToPost'])->name('post-comment');
    Route::get('/comment/{id}/delete', [PostController::class, 'deletePostComment'])->name('delete-comment');

    Route::get('/friends', [FriendController::class, 'index'])->name('friends');
    Route::get('/friend/{id}/accept', [FriendController::class, 'accept'])->name('accept');
    Route::get('/friend/{id}/unfriend', [FriendController::class, 'unfriend'])->name('unfriend');
    Route::get('/friend/{id}/add', [FriendController::class, 'sendFriendRequest'])->name('send-friend-request');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('send-message');
    Route::get('/messages/{sender_id}/delete', [MessageController::class, 'deleteMessage'])->name('delete-message');


    Route::get('/saved-posts', [SavedPostController::class, 'index'])->name('saved-posts');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/save', [SettingController::class, 'saveSettings'])->name('save-settings');
});
