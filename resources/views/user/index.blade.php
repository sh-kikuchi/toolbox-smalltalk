@extends('layouts.app')
@section('content')

<div class="container">
     <form method="POST" action="{{ route('user.search') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <input class="form-control" type="text" name = "keyword" placeholder="ユーザー名で検索して下さい。" required>
           <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <a  class="btn btn-primary" href="{{ route('user.index') }}">戻る</a>
       @isset ($keyword)<p>検索結果:{{ $keyword }}</p>@endisset

      @foreach($users as $user)
    <table class="table-striped">
            <tr>
                <th style="width: 20%" >名前</th>
                <th style="width: 60%">コメント</th>
                <th style="width: 20%">ボタン</th></th>
            </tr>
            <tr>
                <td scope="row" style="width: 20%" ><img src="{{ asset('images/portrait.png')}}"> {{ $user -> name }}</td>
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
      </table>
    @endforeach
</div>
@endsection
