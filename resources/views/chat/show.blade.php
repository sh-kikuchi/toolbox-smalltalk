@extends('layouts.app')
@section('content')

<form method="POST" action="{{ route('chat.store') }}">
{{ csrf_field() }}
<div class="form-group row">
    <input class="form-control col-8 col-sm-10 ml-3 " type="text" name = "chat_text" placeholder="200字以内で投稿して下さい。" maxlength="200" required>
    <button type="submit" name="channel_id" value = "{{ $channel }}" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
</div>
</form>

<div>
     <a href="{{ route('user.index', $channel) }}">リスト{{ $channel }}</a>
</div>

@foreach($chats as $chat)
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <img src="{{ asset('storage/img/' . $chat -> user -> image)}}" class="rounded-circle">
    <div class="media-body px-1 text-break">
        <h5 class="mt-0">{{ $chat -> user -> name }}</h5>
        {{ $chat -> chat }}
        <div class="float-right">
            <a  class="btn btn-success"href="{{ route('comment.show', $chat ) }}"><i class="fas fa-comment"></i></a>
            @if(Auth::user()->id === $chat->user_id)
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary js-modal-open" href="" data-target="chat-modal" data-channel_id = "{{ $channel }}" data-chat_id = "{{ $chat -> id }}" data-chat_text = "{{ $chat -> chat }}" ><i class="fas fa-pen"></i></button>
                <a class="btn btn-danger"  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="/chat/destroy/{{ $channel }}/{{ $chat->id }}"><i class="far fa-trash-alt"></i></a>
            @endif
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center py-4">
{{ $chats->links() }}
</div>

@endsection
