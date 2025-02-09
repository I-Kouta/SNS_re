<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
class UsersController extends Controller

{
    //
    public function usersProfile($id){
        $posts = Post::with("user")
        ->where("user_id", $id)
        ->orderBy("updated_at", "desc")->get();
        $user = User::find($id);
        return view("users.usersProfile", compact("posts", "user"));
    }

    public function profile(){
        return view("users.profile");
    }

    public function profileUpdate(ProfileUpdateFormRequest $request){
        $data = $request->input();
        $id = Auth::id();
        User::where("id", $id)->update([
            "username" => $data["username"],
            "mail" => $data["mail"],
            "bio" => $data["bio"],
            "password" => bcrypt($data["password"])
        ]);
        if($request->hasFile("image")){ // ファイルが含まれているか
            $images = $request->file("image")->getClientOriginalName(); // 複数回使う記述は変数でまとめる
            $request->file("image")->storeAs("public", $images);
            User::where("id", $id)->update([
                "images" => $images
            ]);
        }
        return redirect("/top");
    }

    public function search(Request $request){
        if($request->isMethod("post")){
            $keyword = $request->input("keyword");
            $query = User::query();
            if(!empty($keyword)){
                $query->where("username", "LIKE", "%{$keyword}%")
                ->where("id", "<>", Auth::id());
            }
            $users = $query->get();
            return view("users.search", compact("users", "keyword"));
        }else{
            $users = User::where("id", "<>", Auth::id())->get();
            return view("users.search", compact("users"));
        }
    }
}
