<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * 作業者が分かるための説明
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password'])
        ]);
    }

    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(RegisterFormRequest $request){
        if($request->isMethod('post')){
            $data = $request->input(); // ここに入力したデータが入っている
            // dd($data); // デバッグ関数
            $request->validate([
                'username' => 'required|string|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users',
                'password' => 'required|string|min:8|max:20|confirmed'
            ]);
            $this->create($data); // ここで実際に登録作業を行っている(64行目へ)
            $request->session()->put('username', $data['username']); // ここでセッションにusernameを保存する
            return redirect('added'); // ユーザー登録完了の画面、次へ進む
        }
        return view('auth.register'); // 新規登録の画面、留まる
    }

    public function added(){
        // ここに新規登録したユーザー情報を書く
        return view('auth.added');
    }
}
