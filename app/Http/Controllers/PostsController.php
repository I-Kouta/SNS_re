<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = Post::with('user')
        ->where(function($query) {
            $query->whereIn("user_id", Auth::user()->follows()->pluck('followed_id'))
            ->orWhere("user_id", Auth::id());
        })
        ->orderBy('updated_at', 'desc')->get();
        return view('posts.index',compact('posts'));
    }

    public function indexToday(){
        $posts = Post::with('user')
        ->where(function($query) {
            $query->whereIn("user_id", Auth::user()->follows()->pluck('followed_id'))
            ->orWhere("user_id", Auth::id());
        });
        $posts = $posts
        ->whereDate("updated_at", Carbon::today())
        ->orderBy('updated_at', 'desc')->get();
        return view('posts.index',compact('posts'));
    }

    public function create(Request $request){
        $post = $request->input('newPost');
        $user_id = Auth::id();
        Post::insert([
            'user_id' => $user_id,
            'post' => $post
        ]);
        return redirect('/top');
    }

    public function update(Request $request){
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        Post::where('id', $id)
        ->update(
            ['post' => $up_post]
        );
        return redirect('/top');
    }

    public function delete($id){
        $post = Post::find($id);
        if ($post->user_id <> Auth::id()) {
            return redirect()->back();
        }
        Post::where('id', $id)->delete();
        return redirect('/top');
    }
}
