<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__frame">
            <button class="header__menu--button">
                <img class="header__menu--image" src="img/menu.png" alt="menu">
            </button>
            <a class="header__logo" href="/">
                Rese
            </a>
            <a class="header__welcome" href="">〇〇〇 さん</a>
        </div>
    </header>

    <main>
        <div class="modal__background">
            <div class="modal__contents">
                <button class="modal__contents--button-close">
                    <img class="modal__contents--image-close" src="img/menu-close.png" alt="close">
                </button>
                <ul class="modal__contents--list">
                    <li><a href="/">Home</a></li>
                    <li>Registration</li>
                    <li>Login</li>
                    <li>Mypage</li>
                    <li>Adminpage</li>
                </ul>
            </div>
        </div>
        <div class="background">
            @yield('content')
        </div>
        <script src="{{ asset('/js/index.js') }}"></script>
    </main>

    <footer>
        <small>Rese, inc.</small>
    </footer>
</body>

</html>
