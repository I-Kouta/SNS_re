<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\User;

class PostsController extends Controller
{
    //
    public function index(){
        $list = Post::with('user')
        ->orderBy('updated_at', 'desc')
        ->get();
        $image = User::get();
        return view('posts.index',compact('list', 'image'));
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
        Post::where('id', $id)
        ->delete();
        return redirect('/top');
    }
}
