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
            <form class="back-button" action="/" method="get">
                @csrf
                <button class="button" type="submit">戻る</button>
            </form>
        </div>
    </div>
@endsection
