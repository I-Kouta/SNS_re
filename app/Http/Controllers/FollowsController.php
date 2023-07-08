<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class FollowsController extends Controller
{
    //
    public function follow($id){
        // followsテーブルに追加する記述
        $follower = Auth::user(); // フォローしているか
        $is_following = $follower->isFollowing($id);
        if(!$is_following) {
            $follower->follows()->attach($id); // フォローしていなければフォローする
            return back();
        }
    }

    public function unFollow($id){ // followsテーブルから削除する記述
        $follower = Auth::user();
        $is_following = $follower->isFollowing($id);
        if($is_following) {
            $follower->follows()->detach($id); // フォローしていればフォロー解除
            return back();
        }
    }

    public function followList(){
        // 誰を(followed_id)フォローしているか
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $posts = Post::with("user")->whereIn('user_id', $following_id)->latest()->get();
        $images = User::whereIn('id', $following_id)->get();
        return view('follows.FollowList', compact('posts', 'images'));
    }

    public function followerList(){
        // 誰が(following_id)自分をフォローしているか
        $followed_id = Auth::user()->followers()->pluck('following_id');
        $posts = Post::with("user")->whereIn('user_id', $followed_id)->latest()->get();
        $images = User::whereIn('id', $followed_id)->get();
        return view('follows.FollowerList', compact('posts', 'images'));
    }
}
