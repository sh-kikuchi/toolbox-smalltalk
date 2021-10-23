@extends('layouts.app')
@section('content')

<form method ="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="media shadow-sm p-3 mb-1 bg-white rounded" >
        <!-- <img src="data:image/png;base64,{{ asset('storage/img/' . $user -> image)}}" class="rounded-circle" width="50"  height="50"> -->
        <div class="text-center pt-1">
            @if(Auth::id() === $user->id)
                <i class="fas fa-user-circle fa-2x mr-2" style="color: #333333"></i>
            @else
                <i class="fas fa-user-circle fa-2x mr-2" style="color: #66CDAA"></i>
            @endif
        </div>
        <div class="media-body">
            <input type="text" class="form-control col-3 border-0 mb-2" value="{{ $user -> name }}"  name="name" maxlength="25">
            @if ($errors->has('name'))
            <div class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
            </div>
            @endif
            <textarea type="text" class="form-control" name="bio" maxlength="200">{{ $user -> bio }}</textarea>
            @if ($errors->has('bio'))
            <div class="help-block">
                  <strong>{{ $errors->first('bio') }}</strong>
            </div>
            @endif
        </div>
    </div>

<div class="form-group pt-4">
    <label for="exampleInputEmail1">メールアドレス</label>
    <input type="email" class="form-control" placeholder="Enter email" value="{{ $user -> email }}" name="email" maxlength="255">
     @if ($errors->has('email'))
        <div class="help-block">
             <strong>{{ $errors->first('email') }}</strong>
        </div>
     @endif
</div>
<div class="form-group">
    <label for="exampleInputPassword1">現在のパスワード</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{ $user -> password }}" name="current_pass" readonly>
</div>
<div class="form-group">
    <label for="exampleInputPassword2">新パスワード</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="new_pass" maxlength="12">
    @if ($errors->has('new_pass'))
        <div class="help-block">
            <strong>{{ $errors->first('new_pass') }}</strong>
        </div>
    @endif
</div>
<!-- <div class="form-group">
    <label for="exampleFormControlFile1">アイコン画像</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" value="{{ $user -> image }}" name="image">
</div> -->
<button type="submit" class="btn btn-primary mx-auto d-block col-3">更新</button>
</form>

@endsection
