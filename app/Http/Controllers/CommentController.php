<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Chat;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $chat = $request -> chat_id;
        $comment = new Comment;
        $comment -> user_id = Auth::User()->id;
        $comment -> chat_id = $chat;
        $comment -> comment  = $request -> comment_text;
        $comment -> save();

        return redirect()->route('comment.show',$chat);
    }

    public function show($chat)
    {
        $chat = chat::where('id',$chat)->first();
        $comments = Comment::where('chat_id',$chat)->get();

        return view('comment.show',compact('chat','comments'));
    }

    public function edit(Request $request)
    {
        $chat = $request -> chat_id;
        $comment =Comment::find($request -> comment_id);
        $comment -> comment  =  $request -> comment_text;
        $comment -> save();
        return redirect()->route('comment.show',$chat);
    }

    public function destroy(chat $chat, Comment $comment)
    {
        // $this->authorize('destroy',$comment);
        $comment = Comment::find($comment -> id);
        $comment->delete();
        return redirect()->route('comment.show',$chat->id);
    }
}
