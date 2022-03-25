<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\Chat;
use App\Admin;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $channel = $request -> channel_id;
            $chats = new Chat;
            $chats -> user_id  = Auth::User()->id;
            $chats -> channel_id  = $channel;
            $chats -> chat  = $request -> chat_text;
            $chats -> save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('chat.show',$channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        try{
            $chats = Chat::where('channel_id',$channel->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

            $admin = Admin::where('channel_id', $channel->id)->get();
            $admin_array = [];
            foreach($admin as $admin){
                array_push($admin_array,$admin->user_id);
            }
        }catch(\Exception $e){
            $e->getMessage();
        }

        return view('chat.show',compact('chats','channel','admin_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            $channel = $request -> channel_id;
            $chat =Chat::find($request -> chat_id);
            $chat -> chat  =  $request -> chat_text;
            $chat -> save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('chat.show',$channel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Chat $chat)
    {
        try{
            $this->authorize('destroy', $chat);
            $channel = $channel -> id;
            $chat = Chat::find($chat->id);
            $chat->delete();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('chat.show',$channel);
    }
}
