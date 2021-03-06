@extends('layouts.app')
@section('content')


<h2 class="text-center mb-5">{{$channel -> name}}のメンバー</h2>
<section>
    <h3 class="text-center">承認済み</h3>
    @if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
    <a  class="mb-2" href="{{ route('chat.show',$channel->id) }}">前画面に戻る</a>
    <form method="POST" action="{{ route('user.search',$channel->id) }}" >
        {{ csrf_field() }}
        <div class="form-group row">
        <input class="form-control form-control col-9 col-sm-10 ml-3" type="text" name = "keyword" placeholder="承認済みのユーザー名で検索して下さい。" required>
        <button type="submit" class="btn btn-secondary col-2 col-sm-1 ml-2"><i class="fas fa-search"></i></button>
        </div>
    </form>

    @isset ($keyword)<p>検索結果:{{ $keyword }} ／ <a  class="btn btn-secondary" href="{{ route('user.index',$channel->id) }}">戻る</a></p>@endisset

    <table class="table-striped mx-auto w-100">
        <tr>
            <th class="w-10 text-center">名前</th>
            <th class="w-75 text-center" style="white-space: normal;">コメント</th>
            <th class="w-10"></th></th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td scope="row" class="d-flex align-items-center">
                <!-- <img src="{{ asset('storage/img/'. $user->image)}}" class="rounded-circle" width="50"  height="50"> {{ $user -> name }} -->
                <div class="d-flex justify-space-between align-items-center pt-2">
                    <div>
                        @if(Auth::id() === $user->id)
                            <i class="fas fa-user-circle fa-2x mr-2" style="color: #333333"></i>
                        @else
                            <i class="fas fa-user-circle fa-2x mr-2 text-primary"></i>
                        @endif
                    </div>
                    <div>
                        {{ $user -> name }}
                    </div>
                </div>
            </td>
            <td scope="row" class="pt-2">{{ $user -> bio }}</td>
            <td>
                @if(in_Array($user->id,$admin_array,true))
                    <form action="{{ route('user.admin',$channel -> id ) }}" method="POST">
                        {{ csrf_field() }}
                        <input hidden type="text" name="user_id" value="{{ $user -> id }}">
                        <button type="submit" class="btn btn-danger mt-1" name = "button" value ="kanri" >管理者</button>
                    </form>
                @else
                    <form action="{{ route('user.admin', $channel -> id ) }}" method="POST">
                        {{ csrf_field() }}
                        <input hidden type="text"  name="user_id" value="{{ $user -> id }}">
                        <button type="submit" class="btn btn-primary mt-1" name="button" value="ippan" >一般</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center py-4">
    {{ $users->links('pagination::bootstrap-4') }}
    </div>
</section>
<section>
    <h3 class="text-center">承認待ち</h3>

    <table class="table-striped mx-auto w-100">
        <tr>
            <th class="w-10 text-center">名前</th>
            <th class="w-75 text-center" style="white-space: normal;">コメント</th>
            <th class="w-10"></th></th>
        </tr>
        @foreach($joins as $join)
        <tr>
            <td scope="row" class="d-flex align-items-center">
                <div class="d-flex justify-space-between align-items-center pt-2">
                    <div>
                        @if(Auth::id() === $join->id)
                            <i class="fas fa-user-circle fa-2x mr-2" style="color: #333333"></i>
                        @else
                            <i class="fas fa-user-circle fa-2x mr-2 text-primary"></i>
                        @endif
                    </div>
                    <div>
                        {{ $join -> name }}
                    </div>
                </div>
            </td>
            <td scope="row" class="pt-2">{{ $join -> bio }}</td>
            <td>
                <div class="d-flex">
                    <form action="{{ route('user.join',$channel -> id ) }}" method="POST">
                        {{ csrf_field() }}
                        <input hidden type="text" name="user_id" value="{{ $join -> id }}">
                        <button type="submit" class="btn btn-primary mt-1 ml-2" name = "button">承認</button>
                    </form>
                    <form action="{{ route('user.reject',$channel -> id ) }}" method="POST">
                        {{ csrf_field() }}
                        <input hidden type="text" name="user_id" value="{{ $join -> id }}">
                        <button type="submit" class="btn btn-danger mt-1 ml-2" name = "button" >拒否</button>
                    </form>
                </div>


            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center py-4">
    {{ $joins->links('pagination::bootstrap-4') }}
    </div>
</section>

@endsection
