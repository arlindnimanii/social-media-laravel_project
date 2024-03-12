<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function index() {
        $posts = Post::where('user_id', auth()->id())->get();

        return view('posts', [
            'posts' => $posts
        ]);
    }

    function create(Request $request) {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        if($request->hasfile('image')) {
            $file = $request['image'];
            $image = time()."_".pathinfo($file, PATHINFO_FILENAME) . "." . pathinfo($file, PATHINFO_EXTENSION);
            Storage::putFileAs('public/posts/', $request['image'], $image);

            if(Post::create(['user_id' => auth()->id(), 'description' => $request->description, 'image' => $image])) {
                return redirect()->back();
            }
        }
        
        return redirect()->back()->with('status', 'Something want wrong!');
    }

    function delete($id) {
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('posts');
    }

    function showPost($id) {
        $post = Post::findOrFail($id);

        return view('post', [
            'post' => $post
        ]);
    }

    function likePost($id) {
        $post = Post::findOrFail($id);
        $like = Like::where('user_id', auth()->id())->where('post_id', $post->id)->first();

        if(!is_null($like)) {
            $like->like = ($like->like == 1) ? 0 : 1;
            $like->save();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
                'like' => 1
            ]);
        }

        return redirect()->route('show-post', ['id' => $id]);
    }

    function addCommentToPost(Request $request, $id) {
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);

        if(Comment::create(['user_id' => auth()->id(), 'post_id' => $id, 'comment' => $request->comment])) {
            return redirect()->back();
        }

        return redirect()->back()->with('status', 'Something want wrong while adding comment!');
    }

    function deletePostComment($id) {
        $comment = Comment::findOrFail($id);

        if($comment->delete()) return redirect()->back();

        return redirect()->back()->with('status', 'Something want wrong while deleting comment!');
    }
}
