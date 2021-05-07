<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;

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

    public function show(){
        $user  = User::where('id',Auth::user()->id) ->first();
        return view('profile.show',['user'=>$user]);
    }

    public function edit(Request $request){
        $user = User::find(Auth::user()->id);
        $user -> name = $request -> username;
        $user -> comment = $request -> comment;

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

    public function other($id){
        $user  = User::where('id',$id) ->first();
        $posts = Post::where('user_id',$id)->get();
        return view('profile.other',['user'=>$user],['posts'=>$posts]);
    }

    #フォロー
    public function follow($id){
        $follower = auth() -> user();                  //ログインユーザー情報を取得
        $is_following = $follower -> isFollowing($id); //フォローしているか。modelの「isFollowing」を参照
        if(!$is_following){
            //フォローしていなければフォローする。
            $follower -> follow($id);                  //modelの「follow」を参照
            return back();
        }
    }

    #フォローをはずす
    public function unfollow($id){
        $follower = auth() -> user();                  //ログインユーザー情報を取得
        $is_following = $follower -> isFollowing($id); //フォローしているか。modelの「isFollowing」を参照
        if($is_following){
            //フォローしていればフォローを解除する。
            $follower -> unfollow($id);                //modelの「unfollow」を参照
            return back();
        }
    }
}
