@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-secondary">{{session('message')}}</div>
@endif
@if ($errors->has('channel_name'))
    <div class="help-block alert alert-secondary">
          <strong>{{ $errors->first('channel_name') }}</strong>
    </div>
@endif

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">チャンネル作成</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">チャンネル検索</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <form method="POST" action="{{ route('channel.store') }}">
        {{ csrf_field() }}
            <div class="form-group row">
                <input class="form-control col-8 col-sm-10 ml-3 d-block" type="text" name = "channel_name" placeholder="チャンネル名を記入してください。" maxlength="200" required>

                <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="fas fa-plus-circle"></i></button>
            </div>
        </form>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <form method="POST" action="{{ route('channel.join') }}">
        {{ csrf_field() }}
            <div class="form-group row">
                <input class="form-control col-8 col-sm-10 ml-3 d-block" type="text" name = "channel_add" placeholder="参加するチャンネル名を記入してください" maxlength="200" required>
                <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="fas fa-search"></i></button>
            </div>
       </form>
  </div>
</div>

<section>
<p class="text-center">チャンネル参加リスト</p><hr>
@foreach($channels as $channel)
<div class=" row media shadow-sm p-3 mb-1 bg-white rounded">
    <div class="media-body px-1 text-break d-flex justify-content-between">
        <div class="mt-0" >{{ $channel -> name }}
        </div>

        <div class="float-right">
            <a  class="btn btn-success"href="{{ route('chat.show', $channel->id ) }}">参加</a>
            <a class="btn btn-danger"  onclick="return confirm('このチャンネルを退会しますか?')" rel="nofollow" data-method="delete" href="{{ route('channel.delete', $channel->id ) }}">退会</a>
        </div>
    </div>
</div>
@endforeach

<div class="d-flex justify-content-center py-4">
{{ $channels->links('pagination::bootstrap-4') }}
</div>

</section>
<section>
<p class="text-center">承認待ち</p><hr>
@foreach($joins as $join)
<div class=" row media shadow-sm p-3 mb-1 bg-white rounded">
    <div class="media-body px-1 text-break d-flex justify-content-between">
        <div class="mt-0" >{{ $join -> name }}
        </div>
    </div>
</div>
@endforeach
<div class="d-flex justify-content-center py-4">
{{ $joins->links('pagination::bootstrap-4') }}
</div>

</section>
@endsection
