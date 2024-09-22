@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/fortify-common.css') }}">
@endsection

@section ('content')
    <div class="card">
        <div class="card__title">
            Login
        </div>
        <form class="card__contents" action="/login" method="post">
            @csrf
            <div>
                <img src="{{ asset('img/email.png') }}" alt="メールのアイコン">
                <input class="card__contents__input-box" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                @error ('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <img src="{{ asset('img/password.png') }}" alt="鍵のアイコン">
                <input class="card__contents__input-box" type="password" name="password" placeholder="Password">
                @error ('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button class="card__contents--button-submit" type="submit">ログイン</button>
        </form>
    </div>
@endsection
