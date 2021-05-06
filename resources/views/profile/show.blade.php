@extends('layouts.app')
@section('content')
<div class="container">
    <form method ="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="media">
             <img src="/storage/img/{{ $user -> image }}" class="rounded-circle" width="50"  height="50">
             <div class="media-body">
                  <input type="text" class="form-control" value="{{ $user -> name }}"  name="username">
                  <textarea type="text" class="form-control" name="comment">{{ $user -> comment }}</textarea>
            </div>
       </div>
        <div class="form-group">
              <label for="exampleInputEmail1">メールアドレス</label>
              <input type="email" class="form-control" placeholder="Enter email" value="{{ $user -> email }}" name="email">
        </div>
        <div class="form-group">
              <label for="exampleInputPassword1">現在のパスワード</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="{{ $user -> password }}" name="current_pass">
        </div>
        <div class="form-group">
              <label for="exampleInputPassword2">新パスワード</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="new_pass">
        </div>
        <div class="form-group">
              <label for="exampleFormControlFile1">アイコン画像</label>
              <input type="file" class="form-control-file" id="exampleFormControlFile1" value="{{ $user -> image }}" name="image">
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
 </form>
</div>
@endsection
