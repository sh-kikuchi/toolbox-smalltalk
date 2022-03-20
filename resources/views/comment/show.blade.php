@extends('layouts.app')
@section('content')
<div class="media shadow-sm p-3 mb-1 bg-white rounded">
    <!-- <img src="{{ asset('images/portrait.png')}}" class="rounded-circle"> -->
		<div>
				@if(Auth::user()->id === $chat->user->id)
						<i class="fas fa-user-circle fa-3x mr-2" style="color: #333333"></i>
				@else
						<i class="fas fa-user-circle fa-3x mr-2 text-primary"></i></i>
				@endif
		</div>
    <div class="media-body px-1">
        <h5 class="mt-0">{{ $chat -> user -> name }}</h5>
        {{ $chat -> chat }}
    </div>
</div>
<div>
		<h4 class="text-center mt-4">コメント一覧</h4>
		<form method="POST" action="{{ route('comment.store') }}" class=" ml-3">
		{{ csrf_field() }}
		<div class="form-group row">
		    <input hidden name="chat_id" value= {{ $chat -> id }} >
				<input class="form-control col-8 col-sm-10 ml-3" type="text" name = "comment_text" placeholder="コメント" maxlength="200" required>
				<button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="far fa-paper-plane"></i></button>
		</div>
		</form>
		@foreach($chat -> comments as $comments)
		<div class="media shadow-sm p-3 mb-1 bg-white rounded">
		  @if(Auth::user()->id === $comments->user_id)
        <!-- <img src="{{ asset('storage/img/' . $comments -> user -> image)}}" class="rounded-circle order-1" width="50"  height="50"> -->
				<div>
						<i class="fas fa-user-circle fa-3x mr-2" style="color: #333333"></i>
				</div>
				<div class="media-body px-1 order-2">
				    <h5 class="mt-0"></h5>
						{{ $comments ->comment }}
						<div class="float-right">
									<!-- Button trigger modal -->
									<button type="submit" class="btn btn-primary js-modal-open" href="" data-target="comment-modal" data-chat_id = "{{ $chat -> id }}"
									data-comment_id="{{ $comments->id}} " data-comment_text="{{ $comments-> comment }}"><i class="fas fa-pen"></i></button>
									<a class="btn btn-danger"  onclick="return confirm('このコメントを削除して良いですか?')" rel="nofollow" data-method="delete" href="/comment/destroy/{{ $chat-> id }} / {{ $comments->id }}"><i class="far fa-trash-alt"></i></a>
						</div>
				</div>
			@else
        <img src="{{ asset('storage/img/' . $comments -> user -> image)}}" class="rounded-circle order-2" width="50"  height="50">
				<div class="media-body px-1 order-1" order-1>
						<h5 class="mt-0"></h5>
						{{ $comments ->comment }}
				</div>
		   @endif
		</div>
		@endforeach
</div>
@endsection
