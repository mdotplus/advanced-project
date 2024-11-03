@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section ('content')
    <div class="contents">
        <div class="shop">
            <div class="title-group">
                <a class="button-back" href="/mypage">
                    <img class="button-back__image" src="{{ asset('img/arrow-back.svg') }}" alt="back">
                </a>
                <div class="shop__name">{{ $reservedShop->shop->name }}</div>
            </div>
            <img class="shop__image" src="{{ $reservedShop->shop->image_url }}" alt="店舗写真">
            <div class="shop__hashtag">
                <span class="shop__hashtag--area">#{{ $reservedShop->shop->area['area'] }}</span>
                <span class="shop__hashtag--category">#{{ $reservedShop->shop->category['category'] }}</span>
            </div>
            <p class="shop__profile">{{ $reservedShop->shop->profile }}</p>
        </div>
        <form class="reservation" action="/review/update" method="post">
            @csrf
            <div class="reservation__title">予約</div>
            <div class="reservation__summary">
                <div class="reservation__summary--labels">
                    <span>Shop</span>
                    <span>Date</span>
                    <span>Time</span>
                    <span>Number</span>
                </div>
                <div class="reservation__summary--contents">
                    <span>{{ $reservedShop->shop->name }}</span>
                    <span class="reservation__summary--contents-date">{{ $reservedShop->date }}</span>
                    <span class="reservation__summary--contents-time">{{ substr($reservedShop->time, 0, 5) }}</span>
                    <span class="reservation__summary--contents-number">{{ $reservedShop->number }}人</span>
                </div>
            </div>
            <div class="review__title">レビュー</div>
            <div class="review">
                @if (isset($review))
                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                    <select class="review__point" name="five_point_scale">
                        <option value="" selected disabled>評価</option>
                        <option value=1 {{ $review->five_point_scale === 1 ? 'selected' : '' }}>★</option>
                        <option value=2 {{ $review->five_point_scale === 2 ? 'selected' : '' }}>★★</option>
                        <option value=3 {{ $review->five_point_scale === 3 ? 'selected' : '' }}>★★★</option>
                        <option value=4 {{ $review->five_point_scale === 4 ? 'selected' : '' }}>★★★★</option>
                        <option value=5 {{ $review->five_point_scale === 5 ? 'selected' : '' }}>★★★★★</option>
                    </select>
                    <textarea name="comment" rows="10" cols="30">{{ $review->comment }}</textarea>
                @else
                    <input type="hidden" name="review_id" value="">
                    <select class="review__point" name="five_point_scale">
                        <option value="" selected disabled>評価</option>
                        <option value=1>★</option>
                        <option value=2>★★</option>
                        <option value=3>★★★</option>
                        <option value=4>★★★★</option>
                        <option value=5>★★★★★</option>
                    </select>
                    <textarea name="comment" rows="10" cols="30" placeholder="コメント"></textarea>
                @endif
            </div>
            <input type="hidden" name="reservation_id" value="{{ $reservedShop->id }}">
            <button class="reservation__button" type="submit">保存する</button>
        </form>
    </div>
@endsection
