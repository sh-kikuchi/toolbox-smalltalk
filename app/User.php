<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','comment','image'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Post');

    }

    public function notes() {
        return $this->hasMany('App\Note');
    }

/*---------------------------------------------------------------------------------------
 フォロー機能の実装
---------------------------------------------------------------------------------------- */
    #自己結合（リレーション）「多」対「多」
    public function followings() {
        //フォローする側のUserから見て、フォローされる側のUserを集める
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }

    public function followers() {
        //フォローされる側のUserから見て、フォローしてくる側のUserを集める
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }

    #フォロー/アンフォロー
    public function follow(Int $user_id){
        return $this -> followings() -> attach($user_id);
    }

    public function unfollow(Int $user_id){
        return $this -> followings() -> detach($user_id);
    }

    ## フォローしているか
    public function isFollowing(Int $user_id){
        return $this -> followings() -> where('followed_id', $user_id) -> first(['users.id']);
    }

    ## フォローされているのか
    public function isFollowed(Int $user_id){

        return  $this -> followers() -> where('following_id', $user_id) -> first(['users.id']);
    }

}
