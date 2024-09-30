<div class="reservations-present">
    <div class="reservations-present__title">予約状況</div>
    @foreach ($reservedShopsPresent as $shop)
        <div class="reservation__summary">
            <div class="reservation__summary--title-group">
                <div class="reservation__summary--image">
                    <img src="{{ asset('img/clock.svg') }}" alt="時計のアイコン">
                </div>
                <div class="reservation__summary--title">予約{{ $loop->iteration }}</div>
            </div>
            <div class="reservation__summary--flex-frame">
                <div class="reservation__summary--labels">
                    <span>Shop</span>
                    <span>Date</span>
                    <span>Time</span>
                    <span>Number</span>
                </div>
                <div class="reservation__summary--contents">
                    <span>{{ $shop->shop->name }}</span>
                    <span class="reservation__summary--contents-date">{{ $shop->date }}</span>
                    <span class="reservation__summary--contents-time">{{ substr($shop->time, 0, 5) }}</span>
                    <span class="reservation__summary--contents-number">{{ $shop->number }}人</span>
                </div>
            </div>
            <form class="reservation__summary--button-change" action="/reservation/modify/{{ $shop->id }}/mypage" method="post">
                @csrf
                <button class="reservation__summary--button" type="submit">変更する</button>
            </form>
            <form class="reservation__summary--button-cancel" action="/reservation/delete" method="post">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $shop->id }}">
                <button class="reservation__summary--button" type="submit">キャンセルする</button>
            </form>
        </div>
    @endforeach
</div>
