<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Channel;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index(Channel $channel)
    {

        $channel = Channel::find($channel->id);
        $users = $channel->users()->paginate(10);

        // $users = User::with(['channels' => function ($query) {
        //     $query->where('channel_user.channel_id','=', '"$channel->id"');
        // }])->paginate(10);

        $admin = Admin::where('channel_id', $channel->id)->get();
        $admin_array = [];
        foreach($admin as $admin){
            array_push($admin_array,$admin->user_id);
        }

        return view('user.index',compact('users','channel','admin','admin_array'));
    }

    public function admin(Channel $channel, Request $request)
    {
        $user_id = $request-> user_id;
        $button  = $request-> button;

        try{
            if($button ==="kanri"){
                //管理の場合
                // $this->authorize('destroy', $channel);
                $admin_cnt = Admin::where('channel_id',$channel->id)->count();

                //管理者は最低でも1人は設定する
                if($admin_cnt!==1){
                    $admin = Admin::where('channel_id',$channel->id)->where('user_id',$user_id)
                    ->delete();
                    return redirect()->route('user.index',compact('channel'));
                }else{
                    session()->flash('message', '管理者を最低1人は設定して下さい');
                    return redirect()->route('user.index',compact('channel'));
                }
            }else{
                //一般の場合
                $admin = new Admin;
                $admin -> user_id    = $user_id;
                $admin -> channel_id = $channel->id;
                $admin -> save();
                return redirect()->route('user.index',compact('channel'));
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    /**
     * ユーザー検索/ユーザーリスト
     */
    public function search(Channel $channel, Request $request){
        $keyword = request()->input('keyword'); /*ワード受取 */

        #キーワードがあった場合
        if(!empty($keyword)){
            //中間テーブルでchannelsとusersの組み合わせを探す
            $users = User::whereHas('channels', function($query)use($channel){
                $query->where('channel_user.channel_id',$channel->id);
            })
            ->where('name','like','%'.$keyword.'%')
            ->paginate(10);

            $admin = Admin::where('channel_id', $channel->id)->get();
            $admin_array = [];
            foreach($admin as $admin){
                array_push($admin_array,$admin->user_id);
            }
            return view('user.index',compact('channel','keyword','users','admin_array'));
        }
    }

    /**
     * プロフィール画面
     */
    public function show(){
        try{
            $user  = User::where('id',Auth::user()->id) ->first();
        }catch(\Exception $e){
            $e->getMessage();
        }
        return view('profile.show',['user'=>$user]);
    }

    public function edit(UserRequest $request){

        try{
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
            // if($request->hasFile('image')){
            //     //アップロードされた画像を保存する
            //     $path = $request->file('image')->store('public/img');
            //     $user->image = $image;
            //     $user->image = basename($path);
            // }

            $user->save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('profile.show');
    }

}
