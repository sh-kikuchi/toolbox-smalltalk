<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $post_id = $request -> post_id;
        $comment = new Comment;
        $comment -> user_id = Auth::User()->id;
        $comment -> post_id = $post_id;
        $comment -> comment  = $request -> comment_text;
        $comment -> save();
        return redirect()->route('comment.show',$post_id);
    }

    public function show($post_id)
    {
        $post = Post::where('id',$post_id)->first();
        $comments = Comment::where('post_id',$post_id)->get();

        return view('comment.show',compact('post','comments','post_id'));
    }

    public function edit(Request $request)
    {
        $post_id = $request -> post_id;
        $comment =Comment::find($request -> comment_id);
        $comment -> comment  =  $request -> comment_text;
        $comment -> save();
        return redirect()->route('comment.show',$post_id);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('destroy',$comment);
        $comment = Comment::find($comment -> id);
        $comment->delete();
        return redirect()->route('comment.show',$post->id);
    }
}
