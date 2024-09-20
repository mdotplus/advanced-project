@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card__contents verify-body">
            <div class="verify-contents">
                <p>ログイン認証メールを送信しました</p>
                <p>60分以内に認証を行ってください</p>
            </div>
            <div class="verify-again">
                <p>メールが届いていませんか？</p>
                <p>もう一度認証メールを送信する場合は<br>こちらをクリック</p>
                <form action="/email/verification-notification" method="post">
                    @csrf
                    <button class="button-resend" type="submit">認証メールを再送信</button>
                </form>
            </div>
        </div>
    </div>

        <form class="card__contents" action="/register" method="post">
            @csrf
            <div>
                <img src="img/person.png" alt="人のアイコン">
                <input class="card__contents__input-box" type="text" name="name" value="{{ old('name') }}" placeholder="Username">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <img src="img/email.png" alt="メールのアイコン">
                <input class="card__contents__input-box" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <img src="img/password.png" alt="鍵のアイコン">
                <input class="card__contents__input-box" type="password" name="password" placeholder="Password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button class="card__contents--button-submit" type="submit">登録</button>
        </form>
@endsection
