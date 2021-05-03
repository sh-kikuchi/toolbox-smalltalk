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
						<td scope="row"><img src="{{ asset('images/portrait.png')}}"> {{ $user -> name }}</td>
						<td scope="row">{{ $user -> comment }}</td>
						<td scope="row"> <button type="text" class="btn btn-primary">follow</button></td>
				</tr>
		</table>
    @endforeach

</div>
@endsection
