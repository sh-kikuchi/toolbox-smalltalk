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
        try{
            $chat_id = $request -> chat_id;
            $comment = new Comment;
            $comment -> user_id = Auth::User()->id;
            $comment -> chat_id = $chat_id;
            $comment -> comment  = $request -> comment_text;
            $comment -> save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('comment.show',$chat_id);
    }

    public function show(Chat $chat)
    {
        try{
            $chat = chat::where('id',$chat->id)->first();
            $comments = Comment::where('chat_id',$chat->id)
            ->orderBy('updated_at', 'desc')->get();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return view('comment.show',compact('chat','comments'));
    }

    public function edit(Request $request)
    {
        try{
            $chat = $request -> chat_id;
            $comment =Comment::find($request -> comment_id);
            $comment -> comment  =  $request -> comment_text;
            $comment -> save();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('comment.show',$chat);
    }

    public function destroy(chat $chat, Comment $comment)
    {
        try{
            $this->authorize('destroy',$comment);
            $comment = Comment::find($comment -> id);
            $comment->delete();
        }catch(\Exception $e){
            $e->getMessage();
        }

        return redirect()->route('comment.show',$chat->id);
    }
}
