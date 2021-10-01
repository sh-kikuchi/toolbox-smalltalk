@extends('layouts.app')
@section('content')

<div class="media">
    <img src="{{ asset('storage/img/' . $user -> image)}}" class="rounded-circle" width="50" height="50">
    <div class="media-body px-1">
        <h5 class="mt-0">{{ $user -> name }}</h5>
        <h5>{{ $user -> bio }}</h5>
    </div>
</div>
@foreach($posts as $post)
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <div class="media-body px-1">
        {{ $post -> post }}
    </div>
</div>
@endforeach
@endsection
