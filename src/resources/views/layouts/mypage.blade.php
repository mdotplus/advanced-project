@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage_reservations_present.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage_reservations_past.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage/mypage_favorites.css') }}">
@endsection

@section ('content')
    <div class="mypage-contents">
        <div class="mypage-contents__left">
            @include ('mypage.reservations_present')
            @include ('mypage.reservations_past')
        </div>
        <div class="mypage-contents__right">
            @include ('mypage.favorites')
        </div>
    </div>
@endsection
