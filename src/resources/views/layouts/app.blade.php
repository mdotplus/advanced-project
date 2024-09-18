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
        <div class="background">
            @yield('content')
        </div>
    </main>

    <footer>
        <small>Rese, inc.</small>
    </footer>
</body>

</html>
