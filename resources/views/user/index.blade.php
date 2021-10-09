@extends('layouts.app')
@section('content')

<form method="POST" action="{{ route('user.search',$channel) }}">
      {{ csrf_field() }}
      <div class="form-group row">
      <input class="form-control form-control col-8 col-sm-10 ml-3" type="text" name = "keyword" placeholder="ユーザー名で検索して下さい。" required>
    <button type="submit" name="channel" value = "{{ $channel }}" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
      </div>
</form>

@isset ($keyword)<p>検索結果:{{ $keyword }}  <a  class="btn btn-primary" href="{{ route('user.index',$channel) }}">戻る</a></p>@endisset


<table class="table-striped">
    <tr>
        <th class="w-10 text-center">名前</th>
        <th class="w-70 text-center" style="white-space: normal;">コメント</th>
        <th class="w-20"></th></th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td scope="row" style="width: 20%" ><img src="{{ asset('storage/img/'. $user->image)}}" class="rounded-circle" width="50"  height="50"> {{ $user -> name }}</td>
        <td scope="row" style="width: 60%">{{ $user -> bio }}</td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center py-4">
{{ $users->links() }}
</div>
@endsection
