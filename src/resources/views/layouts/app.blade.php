<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield ('css')
    @yield ('css_second')
</head>

<body>
    <header class="header">
        <div class="header__frame">
            <div class="header__frame--left">
                <button class="header__menu--button">
                    <img class="header__menu--image" src="{{ asset('img/menu.png') }}" alt="menu">
                </button>
                <a class="header__logo" href="/">
                    Rese
                </a>
                @auth
                    <a class="header__welcome" href="/mypage">{{ Auth::user()->name }} さん</a>
                @endauth
                @guest
                    <a class="header__welcome" href="/mypage">ゲスト さん</a>
                @endguest
            </div>
            <div class="header__frame--right">
                @yield ('searchInHeader')
            </div>
        </div>
    </header>

    <main class="main">
        <div class="modal__background">
            <div class="modal__contents">
                <button class="modal__contents--button-close">
                    <img class="modal__contents--image-close" src="{{ asset('img/menu-close.png') }}" alt="close">
                </button>
                <ul class="modal__contents--list">
                    <li><a href="/">Home</a></li>
                    @guest
                        <li><a href="/register">Register</a></li>
                        <li><a href="/login">Login</a></li>
                    @endguest
                    @auth
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <input type="submit" value="Logout">
                            </form>
                        </li>
                        <li><a href="/mypage">Mypage</a></li>
                        <li><a href="/adminpage">Adminpage</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="background"></div>
        @yield ('content')
        @yield ('content_second')
        <script src="{{ asset('/js/app.js') }}"></script>
    </main>
</body>

</html>
