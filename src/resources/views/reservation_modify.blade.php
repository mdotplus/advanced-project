@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/reservation_modify.css') }}">
@endsection

@section ('content')
    <div class="contents">
        <div class="shop">
            <div class="title-group">
                <a class="button-back" href="/{{ $redirectPath }}">
                    <img class="button-back__image" src="{{ asset('img/arrow-back.svg') }}" alt="back">
                </a>
                <div class="shop__name">{{ $reservation->shop->name }}</div>
            </div>
            <img class="shop__image" src="{{ $reservation->shop->image_url }}" alt="店舗写真">
            <div class="shop__hashtag">
                <span class="shop__hashtag--area">#{{ $reservation->shop->area['area'] }}</span>
                <span class="shop__hashtag--category">#{{ $reservation->shop->category['category'] }}</span>
            </div>
            <p class="shop__profile">{{ $reservation->shop->profile }}</p>
        </div>
        <form class="reservation" action="/reservation/update" method="post">
            @csrf
            <div class="reservation__title">予約</div>
            <div class="reservation__input-contents">
                <input name="reservation_id" value="{{ $reservation->id }}" hidden>
                <input name="shop_id" value="{{ $reservation->shop->id }}" hidden>
                <input class="reservation__date" type="date" name="date" value="{{ $reservation->date }}" min="">
                @error ('date')
                    <div class="error">{{ $message }}</div>
                @enderror
                <select class="reservation__time" name="time">
                    <option value="" disabled>時間</option>
                    <option value="09:00" {{ $reservation->time === '09:00:00' ? 'selected' : '' }}>09:00</option>
                    <option value="09:30" {{ $reservation->time === '09:30:00' ? 'selected' : '' }}>09:30</option>
                    <option value="10:00" {{ $reservation->time === '10:00:00' ? 'selected' : '' }}>10:00</option>
                    <option value="10:30" {{ $reservation->time === '10:30:00' ? 'selected' : '' }}>10:30</option>
                    <option value="11:00" {{ $reservation->time === '11:00:00' ? 'selected' : '' }}>11:00</option>
                    <option value="11:30" {{ $reservation->time === '11:30:00' ? 'selected' : '' }}>11:30</option>
                    <option value="12:00" {{ $reservation->time === '12:00:00' ? 'selected' : '' }}>12:00</option>
                    <option value="12:30" {{ $reservation->time === '12:30:00' ? 'selected' : '' }}>12:30</option>
                    <option value="13:00" {{ $reservation->time === '13:00:00' ? 'selected' : '' }}>13:00</option>
                    <option value="13:30" {{ $reservation->time === '13:30:00' ? 'selected' : '' }}>13:30</option>
                    <option value="14:00" {{ $reservation->time === '14:00:00' ? 'selected' : '' }}>14:00</option>
                    <option value="14:30" {{ $reservation->time === '14:30:00' ? 'selected' : '' }}>14:30</option>
                    <option value="15:00" {{ $reservation->time === '15:00:00' ? 'selected' : '' }}>15:00</option>
                    <option value="15:30" {{ $reservation->time === '15:30:00' ? 'selected' : '' }}>15:30</option>
                    <option value="16:00" {{ $reservation->time === '16:00:00' ? 'selected' : '' }}>16:00</option>
                    <option value="16:30" {{ $reservation->time === '16:30:00' ? 'selected' : '' }}>16:30</option>
                    <option value="17:00" {{ $reservation->time === '17:00:00' ? 'selected' : '' }}>17:00</option>
                    <option value="17:30" {{ $reservation->time === '17:30:00' ? 'selected' : '' }}>17:30</option>
                    <option value="18:00" {{ $reservation->time === '18:00:00' ? 'selected' : '' }}>18:00</option>
                    <option value="18:30" {{ $reservation->time === '18:30:00' ? 'selected' : '' }}>18:30</option>
                    <option value="19:00" {{ $reservation->time === '19:00:00' ? 'selected' : '' }}>19:00</option>
                    <option value="19:30" {{ $reservation->time === '19:30:00' ? 'selected' : '' }}>19:30</option>
                    <option value="20:00" {{ $reservation->time === '20:00:00' ? 'selected' : '' }}>20:00</option>
                    <option value="20:30" {{ $reservation->time === '20:30:00' ? 'selected' : '' }}>20:30</option>
                    <option value="21:00" {{ $reservation->time === '21:00:00' ? 'selected' : '' }}>21:00</option>
                </select>
                @error ('time')
                    <div class="error">{{ $message }}</div>
                @enderror
                <select class="reservation__number" name="number">
                    <option value="" selected disabled>人数</option>
                    <option value=1 {{ $reservation->number === 1 ? 'selected' : '' }}>1人</option>
                    <option value=2 {{ $reservation->number === 2 ? 'selected' : '' }}>2人</option>
                    <option value=3 {{ $reservation->number === 3 ? 'selected' : '' }}>3人</option>
                    <option value=4 {{ $reservation->number === 4 ? 'selected' : '' }}>4人</option>
                    <option value=5 {{ $reservation->number === 5 ? 'selected' : '' }}>5人</option>
                    <option value=6 {{ $reservation->number === 6 ? 'selected' : '' }}>6人</option>
                    <option value=7 {{ $reservation->number === 7 ? 'selected' : '' }}>7人</option>
                    <option value=8 {{ $reservation->number === 8 ? 'selected' : '' }}>8人</option>
                    <option value=9 {{ $reservation->number === 9 ? 'selected' : '' }}>9人</option>
                    <option value=10 {{ $reservation->number === 10 ? 'selected' : '' }}>10人</option>
                </select>
                @error ('number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="reservation__summary">
                <div class="reservation__summary--labels">
                    <span>Shop</span>
                    <span>Date</span>
                    <span>Time</span>
                    <span>Number</span>
                </div>
                <div class="reservation__summary--contents">
                    <span>{{ $reservation->shop->name }}</span>
                    <span class="reservation__summary--contents-date">{{ $reservation->date }}</span>
                    <span class="reservation__summary--contents-time">{{ substr($reservation->time, 0, 5) }}</span>
                    <span class="reservation__summary--contents-number">{{ $reservation->number }}</span>
                </div>
            </div>
            <button class="reservation__button" type="submit">変更を保存する</button>
        </form>
    </div>
    <script src="{{ asset('/js/detail.js') }}"></script>
@endsection
