<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//ログアウト中のページ,ここにログイン時にはいけない
Route::group(["middleware" => "guest"], function() {
  Route::get('/login', 'Auth\LoginController@login')->name('login'); // ルーティング->('任意の名前');
  Route::post('/login', 'Auth\LoginController@login');

  Route::get('/register', 'Auth\RegisterController@registerForm');
  Route::post('/register', 'Auth\RegisterController@register');

  Route::get('/added', 'Auth\RegisterController@added');
  Route::post('/added', 'Auth\RegisterController@added');
});

Route::group(["middleware" => "auth"], function() { //ログイン中のページ
  Route::get('/top','PostsController@index');
  Route::post('/top','PostsController@index');

  Route::get('/top/today','PostsController@indexToday');

  Route::post('post/create', 'PostsController@create');

  Route::get('/{id}/profile','UsersController@profile');
  Route::post('/profile/update','UsersController@profileUpdate');

  Route::post('post/update', 'PostsController@update');

  Route::get('post/{id}/delete', 'PostsController@delete');

  Route::get('/search','UsersController@search'); // ユーザー検索に遷移する
  Route::post('/search','UsersController@search'); // 検索ワードを送る際

  Route::get('/{id}/follow', 'FollowsController@follow');
  Route::get('/{id}/unFollow', 'FollowsController@unFollow');

  Route::get('/follow-list','FollowsController@followList');
  Route::get('/follower-list','FollowsController@followerList');

  Route::get('/user/{id}/profile','UsersController@usersProfile');

  Route::get('/logout','Auth\LoginController@logout');
});
