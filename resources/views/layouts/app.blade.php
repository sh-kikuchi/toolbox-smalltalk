<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <title>smalltalk</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <h3>smalltalk</h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> -->
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">新規登録はこちら</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <ul class="list-group list-group-flush list-unstyled">
                                        <li class="list-group-item">
                                             <a class="dropdown-item" href="{{ route('channel.index') }}">トップ</a>
                                        </li>
                                        <li class="list-group-item">
                                             <a class="dropdown-item" href="{{ route('profile.show') }}">プロフィール</a>
                                        </li>
                                        <li class="list-group-item d-block">
                                             <a class="dropdown-item" href="{{ route('note.show') }}">ひとりごと</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                                 ログアウト
                                             </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest
             <main class="py-4">
                @yield('content')
            </main>
        @else
            <main class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2" >
                            @include('layouts.sidebar')
                        </div>
                        <div class="col-sm-10">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        @endguest
    </div>


    <!-- Modal -->
    <div id="comment-modal" class="js-modal">
        <div class="modal-bg js-modal-close"></div>
        <div class="modal-content">
                <p class="text-center">コメントを編集します</p>
                <form method="POST" action="{{ route('comment.edit') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <input type="text" hidden class="form-control input-chat-id" name ="chat_id">
                    <input type="text" hidden class="form-control input-comment-id" name ="comment_id">
                    </div>
                    <div class="form-group">
                        <label for="comment-text" class="col-form-label">コメント:</label>
                        <textarea class="form-control input-comment-text" name="comment_text" maxlength="200" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto d-block">更新</button>
                    <a class="js-modal-close float-right" href="">✕</a>
                </form>
        </div><!--modal__inner-->
    </div><!--modal-->

    <div id="note-modal" class="js-modal">
        <div class="modal-bg js-modal-close"></div>
        <div class="modal-content">
                <p class="text-center">ひとりごとを訂正してしまいます。</p>
                <form method="POST" action="{{ route('note.edit') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <input type="text" hidden class="form-control input-note-id" name ="note_id">
                    </div>
                    <div class="form-group">
                        <label for="note-text" class="col-form-label">ひとりごと:</label>
                        <textarea class="form-control input-note-text" name="note_text" maxlength="200" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto d-block">更新</button>
                    <a class="js-modal-close float-right" href="">✕</a>
                </form>
        </div><!--modal__inner-->
    </div><!--modal-->

    <div id="chat-modal" class="js-modal">
        <div class="modal-bg js-modal-close"></div>
        <div class="modal-content">
                <p class="text-center">内容の更新をします</p>
                <form method="POST" action="{{ route('chat.edit') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                    <input type="text" hidden class="form-control input-channel-id" name ="channel_id">
                    <input type="text" hidden class="form-control input-chat-id" name ="chat_id">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control input-chat-text" name="chat_text" maxlength="200" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto d-block">更新</button>
                    <a class="js-modal-close float-right" href="">✕</a>
                </form>
        </div><!--modal__inner-->
    </div><!--modal-->


</body>
</html>
