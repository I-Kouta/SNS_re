<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
class PostsController extends Controller

{
    //
    public function index(){
        $posts = Post::with("user")
        ->whereIn("user_id", Auth::user()->follows()->pluck("followed_id"))
        ->orWhere("user_id", Auth::id())
        ->orderBy("updated_at", "desc")->get();
        return view("posts.index",compact("posts"));
    }

    public function create(Request $request){
        $post = $request->input("newPost");
        Post::insert([
            "user_id" => Auth::id(),
            "post" => $post
        ]);
        return redirect("/top");
    }

    public function update(Request $request){
        $id = $request->input("id");
        $up_post = $request->input("upPost");
        Post::where("id", $id)
        ->update([
            "post" => $up_post
        ]);
        return redirect("/top");
    }

    public function delete($id){
        $post = Post::find($id);
        if ($post->user_id <> Auth::id()){
            return redirect()->back();
        }
        Post::where("id", $id)->delete();
        return redirect("/top");
    }
}
