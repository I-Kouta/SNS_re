<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'images'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function follows() // フォローする側
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    public function followers() // フォローされる側
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    // フォローしているか
    public function isFollowing($id)
    {
        // dd($user_id); // 引数のIntを除外して確認。nullでした
        return $this->follows()->where('followed_id', $id)->exists();
    }

    // フォローされているか
    public function isFollowed($id)
    {
        return $this->followers()->where('following_id', $id)->exists();
    }
}
