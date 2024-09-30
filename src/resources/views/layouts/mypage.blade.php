@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage-reservations-present.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage-reservations-past.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage-favorites.css') }}">
@endsection

@section ('content')
    <div class="mypage-contents">
        <div class="mypage-contents__left">
            @include ('mypage.reservations-present')
            @include ('mypage.reservations-past')
        </div>
        <div class="mypage-contents__right">
            @include ('mypage.favorites')
        </div>
    </div>
@endsection
