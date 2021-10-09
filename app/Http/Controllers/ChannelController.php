<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Channel;
use Illuminate\Http\Request;
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
        $channels = Channel::orderBy('updated_at', 'desc')->paginate(10);

        return view('channel.index',['channels'=>$channels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $channel = new Channel;
        $channel -> id =(string) Str::uuid();
        $channel -> user_id  = Auth::User()->id;
        $channel -> name  = $request -> channel_name;
        $channel -> admin = 9;
        $channel -> save();
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
        $channel = new Channel;
        if (Channel::where('name', '=', $request -> channel_name)->count() > 0) {
            $channel =  Channel::where($request -> channel_name);
            $channel -> user_id  = Auth::User()->id;
            $channel -> name  = $request -> channel_name;
            $channel -> save();
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {

        return view('/',$channel->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel)
    {
        // $this->authorize('destroy', $channel);
        $channel = Channel::where('id',$channel);
        $channel->delete();
        return redirect('/');
    }

}
