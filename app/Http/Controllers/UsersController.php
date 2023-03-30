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
        $posts = Post::with('user')
        ->where('user_id', $id)
        ->orderBy('updated_at', 'desc')
        ->get();
        $user = User::where('id', $id)->get();
        return view('users.usersProfile',compact('posts', 'user'));
    }

    public function profile($id){
        $user = User::where('id', $id)->get();
        return view('users.profile',compact('user'));
    }

    protected function update(array $data)
    {
        $id = Auth::id();
        return User::where('id', $id)->update([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'bio' => $data['bio'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function profileUpdate(ProfileUpdateFormRequest $request){
        $data = $request->input();
        $id = Auth::id();
        $this->update($data); // ここで更新
        if(($request['image']) != null){
            User::where('id', $id)->update([
                'images' => $request->file('image')->getClientOriginalName() // storage/app/publicディレクトリに保存したい
            ]);
            $request->file('image')->storeAs('public/', $request->file('image')->getClientOriginalName());
        } else {
            User::where('id', $id)->update([
                'images' => 'Atlas.png'
            ]);
        }
        return redirect('/top');
    }

    public function search(Request $request){
        if($request->isMethod('post')){
            $keyword = $request->input('keyword');
            $query = User::query();
            if(!empty($keyword)){
                $query->where('username', 'LIKE', "%{$keyword}%");
            }
            $user = $query->get();
            return view('users.search', compact('user', 'keyword'));
        }else{
            $user = User::get();
            return view('users.search', compact('user'));
            // return view('users.search',['user'=>$user]);
        }
    }
}
