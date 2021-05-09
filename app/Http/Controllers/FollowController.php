<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{

    public function following() {
        #フォローしている人の画像リスト
        $following_images = User::from('users as u')
           ->Join('follows as f', 'u.id', '=', 'f.followed_id')
           ->where('f.following_id', Auth::user()->id)
           ->get();

        #フォローしている人の投稿リスト
        $followings = User::from('users as u')
           ->Join('follows as f', 'u.id', '=', 'f.followed_id')
           ->Join('posts as p','u.id', '=', 'p.user_id')
           ->where('f.following_id', Auth::user()->id)
           ->paginate(10);

        return view('follow.following',compact('followings','following_images'));
    }

    public function followed()  {
        #フォローされている人の画像リスト
        $follower_images = User::from('users as u')
           ->Join('follows as f', 'u.id', '=', 'f.following_id')
           ->where('f.followed_id', Auth::user()->id)
           ->get();

        #フォローされている人の投稿リスト
        $followers = User::from('users as u')
           ->Join('follows as f', 'u.id', '=', 'f.following_id')
           ->Join('posts as p','u.id', '=', 'p.user_id')
           ->where('f.followed_id', Auth::user()->id)
           ->paginate(10);
        return view('follow.followed',compact('followers','follower_images'));
    }

}
