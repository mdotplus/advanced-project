@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card__contents">
            <div class="thanks-contents">
                <p>ご登録ありがとうございます</p>
            </div>
            <form class="thanks__button" action="/login" method="post">
                @csrf
                <button class="button" type="submit">ログインする</button>
            </form>
        </div>
    </div>
@endsection
