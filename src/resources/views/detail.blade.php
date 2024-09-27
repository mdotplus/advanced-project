@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section ('content')
    <div class="contents">
        <div class="shop">
            <div class="title-group">
                <a class="button-back" href="/">
                    <img class="button-back__image" src="{{ asset('img/back.png') }}" alt="back">
                </a>
                <div class="shop__name">{{ $shop->name }}</div>
            </div>
            <img class="shop__image" src="{{ $shop->image_url }}" alt="店舗写真">
            <div class="shop__hashtag">
                <span class="shop__hashtag--area">#{{ $shop->area['area'] }}</span>
                <span class="shop__hashtag--category">#{{ $shop->category['category'] }}</span>
            </div>
            <p class="shop__profile">{{ $shop->profile }}</p>
        </div>
        <form class="reservation" action="/done" method="post">
            @csrf
            <div class="reservation__title">予約</div>
            <div class="reservation__input-contents">
                <input name="user_id" value="{{ Auth::id() }}" hidden>
                <input name="shop_id" value="{{ $shop->id }}" hidden>
                <input class="reservation__date" type="date" name="date" min="">
                <select class="reservation__time" name="time">
                    <option value="" selected disabled>時間</option>
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                </select>
                <select class="reservation__number" name="number">
                    <option value="" selected disabled>人数</option>
                    <option value=1>1人</option>
                    <option value=2>2人</option>
                    <option value=3>3人</option>
                    <option value=4>4人</option>
                    <option value=5>5人</option>
                    <option value=6>6人</option>
                    <option value=7>7人</option>
                    <option value=8>8人</option>
                    <option value=9>9人</option>
                    <option value=10>10人</option>
                </select>
            </div>
            <div class="reservation__summary">
                <div class="reservation__summary--labels">
                    <span>Shop</span>
                    <span>Date</span>
                    <span>Time</span>
                    <span>Number</span>
                </div>
                <div class="reservation__summary--contents">
                    <span>{{ $shop->name }}</span>
                    <span class="reservation__summary--contents-date">-</span>
                    <span class="reservation__summary--contents-time">-</span>
                    <span class="reservation__summary--contents-number">-</span>
                </div>
            </div>
            <button class="reservation__button" type="submit">予約する</button>
        </form>
    </div>
    <script src="{{ asset('/js/detail.js') }}"></script>
@endsection
