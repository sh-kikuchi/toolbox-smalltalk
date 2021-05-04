@extends('layouts.app')
@section('content')
<div class="container">
    <div class="media">
        <img src="{{ asset('images/portrait.png')}}">
        <div class="media-body">
          <h5 class="mt-0">{{ $user -> name }}</h5>
          <h5>{{ $user -> comment }}</h5>
        </div>
    </div>
    <table class="table-striped">
      <tr>
          <th>投稿内容</th>
          <th>日時</th>
      </tr>
			 @foreach($posts as $post)
      <tr>
          <td>  {{ $post -> post }}</td>
          <td>  {{ $post -> updated_at }}</td>
      </tr>
			 @endforeach
　　</table>

</div>
@endsection
