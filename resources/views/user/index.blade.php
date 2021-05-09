@extends('layouts.app')
@section('content')

<form method="POST" action="{{ route('user.search') }}">
      {{ csrf_field() }}
      <div class="form-group row">
      <input class="form-control col-10 ml-3" type="text" name = "keyword" placeholder="ユーザー名で検索して下さい。" required>
      <button type="submit" class="btn btn-secondary col-1 ml-2"><i class="fas fa-search"></i></button>
      </div>
</form>

@isset ($keyword)<p>検索結果:{{ $keyword }}  <a  class="btn btn-primary" href="{{ route('user.index') }}">戻る</a></p>@endisset


<table class="table-striped">
    <tr>
        <th class="w-10 text-center">名前</th>
        <th class="w-70 text-center" style="white-space: normal;">コメント</th>
        <th class="w-20"></th></th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td scope="row" style="width: 20%" ><img src="{{ asset('storage/img/'. $user->image)}}" class="rounded-circle" width="50"  height="50"> {{ $user -> name }}</td>
        <td scope="row" style="width: 60%">{{ $user -> comment }}</td>
        <td scope="row">
            <div class="d-flex justify-content-end flex-grow-1">
                @if (auth()->user()->isFollowing($user->id))
                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-danger">フォロー解除</button>
                    </form>
                @else
                    <form action="{{ route('follow', $user->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">フォローする</button>
                    </form>
                 @endif
            </div>
         </td>
    </tr>
    @endforeach
</table>

<div class="d-flex justify-content-center py-4">
{{ $users->links() }}
</div>
@endsection
