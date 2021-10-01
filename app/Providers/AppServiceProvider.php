<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Follow;
use App\Post;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view){

            $user_id = Auth::id();

            $cnt_following = Follow::where('following_id',$user_id)
             ->count();

            $cnt_follower = Follow::where('follower_id',$user_id)
             ->count();

            $cnt_post =  Post::where('user_id',$user_id)
             ->count();


        //...with this variable
          $view->with('cnt_following',$cnt_following );
          $view->with('cnt_follower',$cnt_follower);
          $view->with('cnt_post',$cnt_post);
    });

    }
}
