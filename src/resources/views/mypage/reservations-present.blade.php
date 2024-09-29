<div class="reservations-present">
    <div class="reservations-present__title">予約状況</div>
    <div class="reservation__summary">
        <div class="reservation__summary--title-group">
            <div class="reservation__summary--image">
                <img src="{{ asset('img/clock.svg') }}" alt="時計のアイコン">
            </div>
            <div class="reservation__summary--title">予約1</div>
        </div>
        <div class="reservation__summary--flex-frame">
            <div class="reservation__summary--labels">
                <span>Shop</span>
                <span>Date</span>
                <span>Time</span>
                <span>Number</span>
            </div>
            <div class="reservation__summary--contents">
                <span>店舗名</span>
                <span class="reservation__summary--contents-date">-</span>
                <span class="reservation__summary--contents-time">-</span>
                <span class="reservation__summary--contents-number">-</span>
            </div>
        </div>
        <form class="reservation__summary--button-change" action="" method="post">
            <button class="reservation__summary--button" type="submit">変更する</button>
        </form>
        <form class="reservation__summary--button-cancel" action="" method="post">
            <button class="reservation__summary--button" type="submit">キャンセルする</button>
        </form>
    </div>
</div>
