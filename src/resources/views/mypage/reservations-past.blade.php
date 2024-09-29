<div class="reservations-past">
    <div class="reservations-past__title">過去の予約</div>
    <div class="reservations-past-cards">
        @foreach ($reservedShops as $shop)
            <div class="reservations-past-card card-{{ $shop->shop_id }}">
                <img class="reservations-past-card__image" src="{{ $shop->shop->image_url }}" alt="店舗写真">
                <div class="reservations-past-card__contents">
                    <div class="card__id" hidden>{{ $shop->shop_id }}</div>
                    <div class="reservations-past-card__name">{{ $shop->shop->name }}</div>
                    <div class="reservations-past-card__click-contents">
                        <form class="reservations-past-card__detail" action="/detail/{{ $shop->shop_id }}/mypage" method="get">
                            @csrf
                            <button class="reservations-past-card__detail-button" type="submit">詳細</button>
                        </form>
                        <form class="reservations-past-card__favorite" action="/favorite/{{ Auth::id() }}/{{ $shop->shop_id }}" method="post">
                            @csrf
                            <button class="reservations-past-card__favorite-button" type="submit">
                                @if (in_array($shop->shop_id, $favoriteShopIds))
                                    <image class="reservations-past-card__favorite--heart-image" src="{{ asset('img/heart-red.svg') }}" alt="赤色のハート">
                                @else
                                    <image class="reservations-past-card__favorite--heart-image" src="{{ asset('img/heart-gray.svg') }}" alt="灰色のハート">
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
