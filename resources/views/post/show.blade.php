@extends('layouts.app')
@section('content')

<form method="POST" action="{{ route('post.store') }}">
{{ csrf_field() }}
<div class="form-group row">
    <input class="form-control col-10 ml-3" type="text" name = "post_text" placeholder="200字以内で投稿して下さい。" maxlength="200" required>
    <button type="submit" class="btn btn-secondary col-1 ml-2"><i class="far fa-paper-plane"></i></button>
</div>
</form>

@foreach($posts as $post)
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <img src="{{ asset('images/portrait.png')}}" class="rounded-circle">
    <div class="media-body px-1 text-break">
        <h5 class="mt-0">{{ $post -> user -> name }}</h5>
        {{ $post -> post }}
        <div class="float-right">
             <a  class="btn btn-success"href="{{ route('comment.show', $post->id ) }}"><i class="fas fa-comment"></i></a>

            @if(Auth::user()->id === $post->user_id)
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary js-modal-open" href="" data-target="post-modal" data-post_id="{{$post->id}}" data-post_text="{{ $post-> post }}"><i class="fas fa-pen"></i></button>
                <a class="btn btn-danger"  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="/post/destroy/{{ $post->id }}"><i class="far fa-trash-alt"></i></a>
            @endif
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center py-4">
{{ $posts->links() }}
</div>

@endsection
