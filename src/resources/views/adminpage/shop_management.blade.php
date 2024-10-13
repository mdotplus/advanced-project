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
                                    {{ empty($validReservations[$shop->id]) ? 0 : count($validReservations[$shop->id]['all']) }}
                                </span>
                                 件
                            </div>
                            <div class="shop-card__reservation--today">
                                うち、本日<br>
                                <span class="shop-card__reservation--number">
                                    {{ empty($validReservations[$shop->id]) ? 0 : count($validReservations[$shop->id]['today']) }}
                                </span>
                                 件
                            </div>
                            <button class="shop-card__reservation--detail-button" type="button">詳細を見る</button>
                        </div>
                        <img class="shop-card__image" src="{{ $shop->image_url }}" alt="店舗写真">
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
                <div class="edit-menu">
                    <button
                        class="edit-menu__modify-button"
                        type="button"
                    >
                        編集する
                    </button>
                    <form action="/adminpage/delete" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $shop->id }}">
                        <button class="edit-menu__delete-button" type="submit">削除する</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    {{ $users->links() }}
    <div class="shop-modal__background">
        <div class="shop-modal__contents-frame">
            <button class="shop-modal__contents--button-close">
                <img class="shop-modal__contents--image-close" src="{{ asset('img/menu-close.png') }}" alt="close">
            </button>
            <form class="shop-modal__contents--items" action="/adminpage/update" method="post">
                @csrf
                <input class="shop-modal__contents--items-shop-id" type="hidden" name="user_id" value="">
                <div class="shop-modal__contents--items-name-frame">
                    <img class="shop-modal__contents--items-name-image" src="img/person-blue.svg" alt="人のアイコン">
                    <span class="shop-modal__contents--items-name"></span>
                </div>
                <div class="shop-modal__contents--items-email-frame">
                    <img class="shop-modal__contents--items-email--image" src="img/email-blue.svg" alt="メールのアイコン">
                    <span class="shop-modal__contents--items-email"></span>
                </div>
                <div class="shop-modal__contents--items-authority-frame">
                    <img class="shop-modal__contents--items-authority--image" src="img/flag-blue.svg" alt="旗のアイコン">
                    <select class="shop-modal__contents--items-authority" name="authority_id">
                        <option value=1>管理者</option>
                        <option value=2>店舗代表者</option>
                        <option value=3>利用者</option>
                    </select>
                </div>
                <button class="shop-modal__contents--items-button" type="submit">保存する</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('/js/shop_management_search.js') }}"></script>
    <script src="{{ asset('/js/shop_management_modal.js') }}"></script>
@endsection
