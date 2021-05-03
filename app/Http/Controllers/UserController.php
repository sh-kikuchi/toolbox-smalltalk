<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id','<>', Auth::User()->id)->orWhereNull('id')->get();

        return view('user.index',['users'=>$users]);
    }

    public function search(Request $request){
        $keyword = request()->input('keyword'); /*ワード受取 */
        $login_user = Auth::User()->id;

        #キーワードがあった場合
        if(!empty($keyword)){
            $users = User::where('id','<>', $login_user)
             ->where('name','like','%'.$keyword.'%')
             ->orWhereNull('id')
             ->get();
        }

        return view('user.index',['users' => $users],['keyword' => $keyword]);
    }

}
