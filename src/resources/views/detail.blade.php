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
        <form class="reservation" action="" method="post">
            @csrf
            <div class="reservation__title">予約</div>
            <div class="reservation__input-contents">
                <input class="reservation__date" type="date">
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
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                    <option value=7>7</option>
                    <option value=8>8</option>
                    <option value=9>9</option>
                    <option value=10>10</option>
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
                    <span>2024-04-01</span>
                    <span>17:00</span>
                    <span>1人</span>
                </div>
            </div>
            <button class="reservation__button" type="submit">予約する</button>
        </form>
    </div>
@endsection
