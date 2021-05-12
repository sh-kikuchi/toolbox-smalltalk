@extends('layouts.app')
@section('content')

<h2>フォローリスト</h2>

<div class="d-flex flex-nowrap flex-row bd-white mb-3 overflow-auto">
@foreach($following_images -> unique() as $following_image)
    <div class="card border col-3 h-100">
        <a href="{{ route('profile.other', $following_image -> follower_id ) }}">
        <img src="{{ asset('storage/img/' . $following_image -> image)}}" class="rounded-circle" width="50"  height="50">
        {{ $following_image -> name }}</a>
    </div>
@endforeach
</div>

@foreach($followings as $following)
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <a href="{{ route('profile.other', $following -> user_id ) }}">
        <img src="{{ asset('storage/img/' . $following -> image)}}" class="rounded-circle" width="50"  height="50">
    </a>
    <div class="media-body px-2">
        <h5 class="mt-0">{{ $following -> name }}</h5>
        {{ $following -> post }}
    </div>
</div>
@endforeach
<div class="d-flex justify-content-center py-4">
{{ $followings->links() }}
</div>
@endsection
