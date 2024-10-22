@section ('css_second')
    <link rel="stylesheet" href="{{ asset('css/adminpage/shop_management.css') }}">
@endsection

@section ('content_second')
    <hr class="border-line">
    <div class="title-group-second">
        <div class="title-group-second__left">
            <div class="title-group-second__title">店舗情報管理</div>
        </div>
        <div class="title-group-second__right">
            <form class="title-group-second__create-new-shop" action="/adminpage/shop/create/{{ Auth::id() }}" method="get">
                @csrf
                <button class="title-group-second__create-new-shop-button" type="submit">新規店舗情報作成</button>
            </form>
            <div class="title-group-second__search-box">
                <select class="title-group-second__search-box--area">
                    <option value="All area" selected>All area</option>
                    @foreach ($selectOptions['areas'] as $area)
                        <option value="{{ $area->area }}">{{ $area->area }}</option>
                    @endforeach
                </select>
                <select class="title-group-second__search-box--genre">
                    <option value="All genre" selected>All genre</option>
                    @foreach ($selectOptions['categories'] as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <input class="title-group-second__search-box--name" placeholder="Search ...">
            </div>
        </div>
    </div>
    <div class="shop-cards">
        @foreach ($shops as $shop)
            <div class="shop-card-frame shop-card-{{ $shop->id }}">
                <div class="shop-card">
                    <div class="shop-card__id" hidden>{{ $shop->id }}</div>
                    <div class="shop-card-left">
                        <div class="shop-card__reservation">
                            <div class="shop-card__reservation--all">
                                予約<br>
                                <span class="shop-card__reservation--number">
                                    {{
                                        empty($validReservations[$shop->id]) ?
                                        0 :
                                        count($validReservations[$shop->id]['all'])
                                    }}
                                </span>
                                 件
                            </div>
                            <div class="shop-card__reservation--today">
                                うち、本日<br>
                                <span class="shop-card__reservation--number">
                                    {{
                                        empty($validReservations[$shop->id]) ?
                                        0 :
                                        count($validReservations[$shop->id]['today'])
                                    }}
                                </span>
                                 件
                            </div>
                            <button
                                class="shop-card__reservation--detail-button"
                                type="button"
                                value="{{
                                    empty($validReservations[$shop->id]) ?
                                    'no data' :
                                    collect($validReservations[$shop->id]['all'])
                                }}"
                            >
                                詳細を見る
                            </button>
                        </div>
                        @if (is_null($shop->image_url))
                            <div class="shop-card__no-image">NO IMAGE</div>
                        @else
                            <img class="shop-card__image" src="{{ asset($shop->image_url) }}" alt="店舗写真">
                        @endif
                    </div>
                    <div class="shop-card-right">
                        <div class="shop-card-right__top">
                            <div class="shop-card__name">
                                <span class="shop-card__name--title">店舗名</span><br>
                                <span class="shop-card__name--element">{{ $shop->name }}</span>
                            </div>
                            <div class="shop-card__area">
                                <span class="shop-card__area--title">地域</span><br>
                                <span class="shop-card__area--element">{{ $shop->area->area }}</span>
                            </div>
                            <div class="shop-card__genre">
                                <span class="shop-card__genre--title">ジャンル</span><br>
                                <span class="shop-card__genre--element">{{ $shop->category->category }}</span>
                            </div>
                            <div class="shop-card__review">
                                <span class="shop-card__review--title">総合評価</span><br>
                                <div class="shop-card__review--total-point-frame">
                                    <div
                                        class="shop-card__review--total-point-star"
                                        style="--point: {{ empty($reviewPoints[$shop->id]['average']) ? 0 : $reviewPoints[$shop->id]['average'] }}"
                                    >
                                    </div>
                                    <div class="shop-card__review--total-point-number">
                                        @if (empty($reviewPoints[$shop->id]['average']))
                                            <span class="shop-card__review--total-point-number-no-review">レビューがありません</sapn>
                                        @else
                                            <span class="shop-card__review--total-point-number-average">{{ $reviewPoints[$shop->id]['average'] }} 点</sapn>
                                            <span class="shop-card__review--total-point-number-count">( 全 {{ $reviewPoints[$shop->id]['count'] }} 件 )</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-card-right__bottom">
                            <div class="shop-card__profile">
                                <span class="shop-card__profile--title">店舗概要</span><br>
                                <span class="shop-card__profile--element">{{ $shop->profile }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-edit-menu">
                    <button
                        class="shop-edit-menu__modify-button"
                        value="{{ $shop->id }},{{ $shop->name }},{{ $shop->area_id }},{{ $shop->category_id }},{{ $shop->profile }}"
                        type="button"
                    >
                        編集する
                    </button>
                    <form action="/adminpage/delete" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $shop->id }}">
                        <button class="shop-edit-menu__delete-button" type="submit">削除する</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    {{ $users->links() }}
    <div class="shop-modal__layer">
        <div class="shop-modal__background">
            <div class="shop-modal__contents-frame">
                <button class="shop-modal__contents--button-close">
                    <img class="shop-modal__contents--image-close" src="{{ asset('img/menu-close.png') }}" alt="close">
                </button>
                <form class="shop-modal__contents--items" action="/adminpage/shop/update" method="post">
                    @csrf
                    <input class="shop-modal__contents--items-shop-id" type="hidden" name="shop_id" value="">
                    <div class="shop-modal__contents--items-shop-name-frame">
                        <span class="shop-modal__contents--items-shop-name-title">店舗名</span>
                        <span class="shop-modal__contents--items-shop-name"></span>
                    </div>
                    <div class="shop-modal__contents--items-area-frame">
                        <span class="shop-modal__contents--items-area-title">地域</span>
                        <select class="shop-modal__contents--items-area" name="area_id">
                            @foreach ($selectOptions['areas'] as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="shop-modal__contents--items-category-frame">
                        <span class="shop-modal__contents--items-category-title">ジャンル</span>
                        <select class="shop-modal__contents--items-category" name="category_id">
                            @foreach ($selectOptions['categories'] as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="shop-modal__contents--items-profile-frame">
                        <span class="shop-modal__contents--items-profile-title">店舗概要</span>
                        <textarea class="shop-modal__contents--items-profile" name="profile"></textarea>
                    </div>
                    <button class="shop-modal__contents--items-button" type="submit">保存する</button>
                </form>
            </div>
        </div>
    </div>
    <div class="shop-reservations-modal__layer">
        <div class="shop-reservations-modal__background">
            <div class="shop-reservations-modal__contents-frame">
                <button class="shop-reservations-modal__contents--button-close">
                    <img class="shop-reservations-modal__contents--image-close" src="{{ asset('img/menu-close.png') }}" alt="close">
                </button>
                <div class="shop-reservations-modal__contents--items">
                    <div class="shop-reservations-modal__contents--items-shop-info-frame">
                        <div class="shop-reservations-modal__contents--items-shop-name-frame">
                            <img class="shop-reservations-modal__contents--items-shop-name-image" src="{{ asset('img/restaurant.svg') }}" alt="レストランのアイコン">
                            <span class="shop-reservations-modal__contents--items-shop-name"></span>
                        </div>
                        <div class="shop-reservations-modal__contents--items-area-frame">
                            <img class="shop-reservations-modal__contents--items-area-image" src="{{ asset('img/area.svg') }}" alt="地図のアイコン">
                            <span class="shop-reservations-modal__contents--items-area"></span>
                        </div>
                        <div class="shop-reservations-modal__contents--items-genre-frame">
                            <img class="shop-reservations-modal__contents--items-genre-image" src="{{ asset('img/genre.svg') }}" alt="タグのアイコン">
                            <span class="shop-reservations-modal__contents--items-genre"></span>
                        </div>
                    </div>
                    <div class="shop-reservations-modal__contents--items-title-frame">
                        <span class="shop-reservations-modal__contents--items-title">予約状況</span>
                    </div>
                    <div class="shop-reservations-modal__contents--items-table-frame">
                        <table class="shop-reservations-modal__contents--items-table">
                            <div class="shop-reservations-modal__contents--items-no-table">予約がありません</div>
                            <thead class="shop-reservations-modal__contents--items-table-head">
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody class="shop-reservations-modal__contents--items-table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/shop_management_search.js') }}"></script>
    <script src="{{ asset('/js/shop_management_modal.js') }}"></script>
@endsection
