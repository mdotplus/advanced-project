<div class="favorites">
    <div class="favorites__title">お気に入り店舗</div>
    <div class="favorites-cards">
        @foreach ($shops as $shop)
            @if (in_array($shop->id, $favoriteShopIds))
                <div class="favorites-card card-{{ $shop->id }}">
                    @if (is_null($shop->image_url))
                        <div class="favorites-card__no-image">NO IMAGE</div>
                    @else
                        <img class="favorites-card__image" src="{{ $shop->image_url }}" alt="店舗写真">
                    @endif
                    <div class="favorites-card__contents">
                        <div class="card__id" hidden>{{ $shop->id }}</div>
                        <div class="favorites-card__name-frame">
                            <div class="favorites-card__name">{{ $shop->name }}</div>
                        </div>
                        <div class="favorites-card__hashtag">
                            #<span class="card__hashtag--area">{{ $shop->area['area'] }}</span>
                            #<span class="card__hashtag--category">{{ $shop->category['category'] }}</span>
                        </div>
                        <div class="favorites-card__five-point-scale-frame">
                            <span class="favorites-card__five-point-scale" style="--score: {{ empty($reviewPoints[$shop->id]) ? 0 : $reviewPoints[$shop->id]['average'] }}"></span>
                        </div>
                        <div class="favorites-card__click-contents">
                            <form class="favorites-card__detail" action="/detail/{{ $shop->id }}/mypage" method="get">
                                @csrf
                                <button class="favorites-card__detail-button" type="submit">詳しくみる</button>
                            </form>
                            <form class="favorites-card__favorite" action="/favorite/{{ Auth::id() }}/{{ $shop->id }}/mypage" method="post">
                                @csrf
                                <button class="favorites-card__favorite-button" type="submit">
                                    <image class="favorites-card__favorite--heart-image" src="{{ asset('img/heart-red.svg') }}" alt="赤色のハート">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
