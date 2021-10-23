<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Illuminate\Support\Facades\DB;
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
            $cnt_channel = DB::table('channel_user')->where('user_id', Auth::id())
            ->distinct()->select('channel_id')->count();
        //...with this variable
            $view->with('cnt_channel',$cnt_channel);
    });

    }
}
