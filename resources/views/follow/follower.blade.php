@extends('layouts.app')
@section('content')

<h2>フォロワーリスト</h2>
<h5 class="pl-4">アイコンをクリックすると、その方のプロフィールを見ることが出来ます。</h5>
 <p class="text-right">フォロワー数：{{ $cnt_follower }}</p>
<div class="d-flex flex-nowrap flex-row bd-white mb-3 overflow-auto">
@foreach($follower_images -> unique() as $follower_image)
    <div class="card border col-3 h-100 ">
        <a href="{{ route('profile.other', $follower_image -> following_id ) }}">
        <img src="{{ asset('storage/img/' . $follower_image -> image)}}" class="rounded-circle" width="50"  height="50">
        {{ $follower_image -> name }}</a>
    </div>
@endforeach
</div>

@foreach($followers as $follower)
<div class="media shadow-sm p-3 mb-1  bg-white rounded">
    <a href="{{ route('profile.other', $follower -> user_id ) }}">
        <img src="{{ asset('storage/img/' . $follower -> image)}}" class="rounded-circle" width="50"  height="50">
    </a>
    <div class="media-body px-2">
        <h5 class="mt-0">{{ $follower -> name }}</h5>
        {{ $follower -> post }}
    </div>
</div>
@endforeach
<div class="d-flex justify-content-center py-4">
{{ $followers->links() }}
</div>

@endsection
