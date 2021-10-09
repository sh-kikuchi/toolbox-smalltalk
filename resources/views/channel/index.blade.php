@extends('layouts.app')
@section('content')

<div>
    <form method="POST" action="{{ route('channel.store') }}">
    {{ csrf_field() }}
    <div class="form-group row">
        <p><label class="d-block col-12">ちゃんねるをつくる</label></p>
        <input class="form-control col-8 col-sm-10 ml-3 d-block" type="text" name = "channel_name" placeholder="ちゃんねる名を記入してください。" maxlength="200" required>
        <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
    </div>
    </form>
</div>
<div>
    <form method="POST" action="{{ route('channel.join') }}">
    {{ csrf_field() }}
    <div class="form-group row">
        <p><label class="d-block col-12">ちゃんねるに参加する</label></p>
        <input class="form-control col-8 col-sm-10 ml-3 d-block" type="text" name = "channel_add" placeholder="参加するちゃんねる名を記入してください" maxlength="200" required>
        <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
    </div>
    </form>
</div>
<div>
<p>あなたが参加しているちゃんねる</p>
@foreach($channels as $channel)
<div class=" row media shadow-sm p-3 mb-1 bg-white rounded">
    <div class="media-body px-1 text-break d-flex justify-content-between">
        <h5 class="mt-0" >{{ $channel -> id }}</h5>
        <div class="float-right">
            <a  class="btn btn-success"href="{{ route('chat.show', $channel->id ) }}"><i class="fas fa-door-open"></i></a>
            @if($channel->admin === 9)
                <a class="btn btn-danger"  onclick="return confirm('このコメントを削除して良いですか?')" rel="nofollow" data-method="delete" href="{{ route('channel.destroy', $channel->id ) }}"><i class="far fa-trash-alt"></i></a>
            @endif
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center py-4">
{{ $channels->links() }}
</div>

</div>
@endsection
