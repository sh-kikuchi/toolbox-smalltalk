<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Channel;
use App\Chat;
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
        $channel = $request -> channel_id;
        $chats = new Chat;
        $chats -> user_id  = Auth::User()->id;
        $chats -> channel_id  = $channel;
        $chats -> chat  = $request -> chat_text;
        $chats -> save();
        return redirect()->route('chat.show',$channel);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($channel)
    {
        $chats = Chat::where('channel_id',$channel)
         ->orderBy('updated_at', 'desc')
         ->paginate(10);

        return view('chat.show',compact('chats','channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $channel = $request -> channel_id;
        $chat =Chat::find($request -> chat_id);
        $chat -> chat  =  $request -> chat_text;
        $chat -> save();
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
        // $this->authorize('destroy', $channel);
        $channel = $channel -> id;
        $chat = Chat::find($chat->id);
        $chat->delete();
        return redirect()->route('chat.show',$channel);
    }
}