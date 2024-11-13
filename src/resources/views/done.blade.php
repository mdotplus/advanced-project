@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section ('content')
    <div class="card">
        <div class="card__contents">
            <div class="done-contents">
                <p>ご予約ありがとうございます</p>
            </div>
            <form action="/create-checkout-session" method="post">
                @csrf
                <button class="button" type="submit">事前決済する</button>
            </form>
            <form class="back-button" action="/" method="get">
                @csrf
                <button class="button" type="submit">決済せずに戻る</button>
            </form>
        </div>
    </div>
@endsection
