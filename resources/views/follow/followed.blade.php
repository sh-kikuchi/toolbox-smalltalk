@extends('layouts.app')
@section('content')
<div class="container">
    <h2>フォロワーリスト</h2>
    @foreach($followers-> unique() as $follower)
    <div class="media">
        <a href="{{ route('profile.other', $follower -> user_id ) }}">
            <img src="/storage/img/{{ $follower -> image }}" class="rounded-circle">
        </a>
    </div>
    @endforeach
    @foreach($followers as $follower)
    <div class="media">
        <a href="{{ route('profile.other', $follower -> user_id ) }}">
            <img src="/storage/img/{{ $follower -> image }}" class="rounded-circle" width="50"  height="50">
        </a>
        <div class="media-body">
        	<h5 class="mt-0">{{ $follower -> name }}</h5>
        	{{ $follower -> post }}
        </div>
    </div>
    @endforeach
</div>

@endsection
