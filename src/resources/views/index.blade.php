@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section ('searchInHeader')
    <div class="search-box">
        <select class="search-box__area">
            <option value="All area" selected>All area</option>
            @foreach ($selectOptions['areas'] as $area)
                <option value="{{ $area->area }}">{{ $area->area }}</option>
            @endforeach
        </select>
        <select class="search-box__genre">
            <option value="All genre" selected>All genre</option>
            @foreach ($selectOptions['categories'] as $category)
                <option value="{{ $category->category }}">{{ $category->category }}</option>
            @endforeach
        </select>
        <input class="search-box__name" placeholder="Search ...">
    </div>
@endsection

@section ('content')
    <div class="cards">
        @foreach ($shops as $shop)
            <div class="card card-{{ $shop->id }}">
                <img class="card__image" src="{{ $shop->image_url }}" alt="店舗写真">
                <div class="card__contents">
                    <div class="card__id" hidden>{{ $shop->id }}</div>
                    <div class="card__name">{{ $shop->name }}</div>
                    <div class="card__hashtag">
                        #<span class="card__hashtag--area">{{ $shop->area['area'] }}</span>
                        #<span class="card__hashtag--category">{{ $shop->category['category'] }}</span>
                    </div>
                    <div class="card__five-point-scale-frame">
                        <span
                            class="card__five-point-scale"
                            style="--point: {{ empty($reviewPoints[$shop->id]) ? 0 : $reviewPoints[$shop->id] }}"
                        >
                        </span>
                    </div>
                    <div class="card__click-contents">
                        <form class="card__detail" action="/detail/{{ $shop->id }}/home" method="get">
                            @csrf
                            <button class="card__detail-button" type="submit">詳しくみる</button>
                        </form>
                        <form class="card__favorite" action="/favorite/{{ Auth::id() }}/{{ $shop->id }}/home" method="post">
                            @csrf
                            <button class="card__favorite-button" type="submit">
                                @if (in_array($shop->id, $favoriteShopIds))
                                    <image class="card__favorite--heart-image" src="{{ asset('img/heart-red.svg') }}" alt="赤色のハート">
                                @else
                                    <image class="card__favorite--heart-image" src="{{ asset('img/heart-gray.svg') }}" alt="灰色のハート">
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script src="{{ asset('/js/index.js') }}"></script>
@endsection
