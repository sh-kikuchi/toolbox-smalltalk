<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\ChannelRequest;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            //中間テーブルでchannelsとusersの組み合わせを探す
            $channels = Channel::whereHas('users', function($query){
                $query->where('channel_user.user_id', '=', Auth::id());
            })->orderBy('updated_at', 'desc')->paginate(5);
        }catch (\Exception $e) {
            $e->getMessage();
        }

        return view('channel.index',['channels'=>$channels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChannelRequest $request)
    {
        try{
            //チャンネルの情報（channelテーブル）
            $channel_id = (string) Str::uuid();
            $channel = new Channel;
            $channel -> id = $channel_id;
            // $channel -> user_id  = Auth::User()->id;
            $channel -> name  = $request -> channel_name;
            $channel -> save();

            //管理者権限の付与（adminテーブル）
            $admin = new Admin;
            $admin->user_id = Auth::User()->id;
            $admin->channel_id = $channel_id;
            $admin -> save();

            $channel -> users() -> attach(Auth::User()->id);
        }catch (\Exception $e) {
            $e->getMessage();
        }

        return redirect('/');
    }

    /**
     *  join a channel
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {

        try{
            $channel = new Channel;
            $channel = Channel::where('name',$request -> channel_add)->first();

            if($channel !== null){
                $channel -> users() -> attach(Auth::User()->id);
                return redirect('/');
            }else{
                session()->flash('message', '該当のチャンネルがありませんでした。');
                return redirect('/');
            }
        }catch (\Exception $e) {
            $e->getMessage();
            session()->flash('message', '既に追加されています。');
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        try{
            $this->authorize('destroy', $channel);
            $channel = Channel::where('id',$channel->id);
            $channel->delete();
            return redirect('/');
        }catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function delete(Channel $channel)
    {

        //チャンネル参加人数
        $ch_user_cnt = $channel -> users()->count();

        //管理者は最低でも1人は設定する
        if($ch_user_cnt!==1){
            $this->authorize('destroy', $channel);
            $channel = Channel::find($channel->id);
            $channel -> users() -> detach(Auth::User()->id);
            return redirect('/');
        }else{
            session()->flash('message', '参加者が1人のため、チャンネル内で削除して下さい');
            return redirect('/');
        }

    }

}
