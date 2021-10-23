@extends('layouts.app')
@section('content')

<div>
    <h3>{{$channel -> name}}</h3>
    @if(in_Array(Auth::user()->id,$admin_array,true))
    <a class=""  onclick="return confirm('このチャンネルを削除しますか?')" rel="nofollow" data-method="delete" href="{{ route('channel.destroy', $channel->id ) }}">削除</a>
    @endif
</div>


<form method="POST" action="{{ route('chat.store') }}">
{{ csrf_field() }}
<div class="form-group row">
    <input class="form-control col-8 col-sm-10 ml-3 " type="text" name = "chat_text" placeholder="200字以内で投稿して下さい。" maxlength="200" required>
    <button type="submit" name="channel_id" value = "{{ $channel -> id }}" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
</div>
</form>

<div>
     <a href="{{ route('user.index', $channel -> id) }}">参加者リスト</a>
</div>

@foreach($chats as $chat)
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <!-- <img src="{{ asset('storage/img/' . $chat -> user -> image)}}" class="rounded-circle"> -->
    <!-- アイコンの順序 order -->
    <div>
        @if(Auth::id() === $chat->user->id)
            <i class="fas fa-user-circle fa-3x mr-2" style="color: #333333"></i>
        @else
            <i class="fas fa-user-circle fa-3x mr-2 text-primary"></i>
        @endif
    </div>
    <div class="media-body px-1 text-break">
        <h5 class="mt-0">{{ $chat -> user -> name }}</h5>
        {{ $chat -> chat }}
        <div class="float-right">
            <a  class="btn btn-success"href="{{ route('comment.show', $chat ) }}"><i class="fas fa-comment"></i></a>
            @if(Auth::user()->id === $chat->user_id)
                <!-- Button trigger modal -->
                <button type="submit" class="btn btn-primary js-modal-open" href="" data-target="chat-modal" data-channel_id = "{{ $channel -> id }}" data-chat_id = "{{ $chat -> id }}" data-chat_text = "{{ $chat -> chat }}" ><i class="fas fa-pen"></i></button>
                <a class="btn btn-danger"  onclick="return confirm('このカードを削除して良いですか?')" rel="nofollow" data-method="delete" href="/chat/destroy/{{ $channel -> id }}/{{ $chat->id }}"><i class="far fa-trash-alt"></i></a>
            @endif
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center py-4">
{{ $chats->links() }}
</div>

@endsection
