@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="card">
        <img class="card__image" src="img/menu.png" alt="写真">
        <div class="card__contents">
            <div class="card__name">
                店舗名
            </div>
            <div class="card__hashtag">
                <span class="card__hashtag--area">#エリア</span>
                <span class="card__hashtag--category">#ジャンル</span>
            </div>
            <div class="card__five-point-scale-frame">
                <span class="card__five-point-scale" style="--score: 2.3"></span>
            </div>
            <div class="card__click-contents">
                <form action="" method="post">
                    @csrf
                    <button class="card__detail-button" type="submit">詳しくみる</button>
                </form>
                <form action="" method="post">
                    @csrf
                    <button class="card__favorite-button" type="submit">♥</button>
                </form>
            </div>
        </div>
    </div>
@endsection
