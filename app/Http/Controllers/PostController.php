<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post -> user_id    = Auth::User()->id;
        $post -> post  = $request -> post_text;
        $post -> save();
        return redirect('/');
    }

    public function show()
    {
        $posts = Post::all();
        return view('post.show',['posts'=>$posts]);
    }

    public function edit(Request $request)
    {
        $post =Post::find($request -> post_id);
        $post -> post  =  $request -> post_text;
        $post -> save();
        return redirect('/');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/');
    }
}
