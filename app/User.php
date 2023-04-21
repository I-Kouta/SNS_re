<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function posts(){
        return $this->hasMany('App\Post');
    }

    // フォローする(省略しましょう)
    public function follow($id)
    {
        return $this->follows()->attach($id);
    }

    // フォロー解除
    public function unFollow($id)
    {
        return $this->follows()->detach($id);
    }

    // フォローする時
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    // フォローされる時
    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    // フォローしているか
    public function isFollowing($id)
    {
        // dd($user_id); // 引数のIntを除外して確認。nullでした
        return (boolean) $this->follows()->where('followed_id', $id)->first(['follows.id']);
    }

    // フォローされているか
    public function isFollowed($id)
    {
        return (boolean) $this->followers()->where('following_id', $id)->first(['follows.id']);
    }

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
}
