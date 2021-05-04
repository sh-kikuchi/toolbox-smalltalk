@extends('layouts.app')
@section('content')
<div class="container">
     <form method="POST" action="{{ route('post.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <input class="form-control" type="text" name = "post_text" placeholder="投稿してください" required>
    	    <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    @foreach($posts as $post)
    <div class="media">
        <img src="{{ asset('images/portrait.png')}}">
        <div class="media-body">
        	<h5 class="mt-0">{{ $post -> user -> name }}</h5>
        	{{ $post -> post }}
            @if(Auth::user()->id === $post->user_id)
            <div>
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary js-modal-open" href="" data-post_id="{{$post->id}}" data-post_text="{{ $post-> post }}">編集</button>
                <a class="btn btn-danger"  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="/post/destroy/{{ $post->id }}">削除</a>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
<!-- Modal -->
<div class="post-modal js-modal">
    <div class="modal_post_bg js-modal-close"></div>
    <div class="modal_post_content">
            <p>投稿内容を編集します</p>
            <form method="POST" action="{{ route('post.edit') }}">
                {{ csrf_field() }}
                <div class="form-group">
                <input type="text" hidden class="form-control input-post-id" name ="post_id">
                </div>
                <div class="form-group">
                    <label for="post-text" class="col-form-label">投稿内容:</label>
                    <textarea class="form-control input-post-text" name="post_text" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">完了</button>
                <a class="js-modal-close" href="">✕</a>
            </form>
    </div><!--modal__inner-->
</div><!--modal-->
@endsection
