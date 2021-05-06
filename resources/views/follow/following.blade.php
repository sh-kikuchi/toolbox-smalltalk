@extends('layouts.app')
@section('content')
<div class="container">
    <h2>フォローリスト</h2>
    @foreach($followings -> unique() as $following)
    <div class="media">
        <a href="{{ route('profile.other', $following -> user_id ) }}">
            <img src="/storage/img/{{ $following -> image }}" class="rounded-circle">
        </a>
    </div>
    @endforeach
    @foreach($followings as $following)
    <div class="media">
        <a href="{{ route('profile.other', $following -> user_id ) }}">
            <img src="/storage/img/{{ $following -> image }}" class="rounded-circle" width="50"  height="50">
        </a>
        <div class="media-body">
        	<h5 class="mt-0">{{ $following -> name }}</h5>
        	{{ $following -> post }}
        </div>
    </div>
    @endforeach
</div>

@endsection
