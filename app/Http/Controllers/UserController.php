<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Channel;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index($channel)
    {
        $users = User::with(['channels' => function ($query) {
            $query->where('id','=', '$channel');
        }])->paginate(10);

        return view('user.index',['users'=>$users],['channel' => $channel]);
    }

    public function search(Request $request){
        $channel = $request -> channel; /*ワード受取 */
        $keyword = request()->input('keyword'); /*ワード受取 */

        #キーワードがあった場合
        if(!empty($keyword)){
            $users = User::with(['channels' => function ($query) {
                $query->where('id','=', '$channel');
            }])
            ->where('name','like','%'.$keyword.'%')
            ->orWhereNull('id')
            ->paginate(10);
        }
        return view('user.index',['users' => $users],['channel' => $channel],['keyword' => $keyword]);
    }

    public function show(){
        $user  = User::where('id',Auth::user()->id) ->first();
        return view('profile.show',['user'=>$user]);
    }

    public function edit(UserRequest $request){

        $user = User::find(Auth::user()->id);
        $user -> name = $request -> name;
        $user -> bio = $request -> bio;

       #メールアドレスの入力がある場合
        if($user->email !== $request->email){
            $user->email  = $request->email;
        }

       #新パスワードに入力がある場合。
        if (!empty($request -> new_pass)){
            $user -> password =bcrypt($request -> new_pass);
        }

       #アイコン画像がある場合。
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/img'); //アップロードされた画像を保存する
            $user->image = basename($path);
        }

        $user->save();
        return redirect()->route('profile.show');
    }

    public function other($user){
        $user  = User::where('id',$user) ->first();
        $posts = Post::where('user_id',$user->id)->get();
        return view('profile.other',['user'=>$user],['posts'=>$posts]);
    }

}
