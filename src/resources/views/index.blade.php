@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section ('content')
    <div class="cards">
        @foreach ($shops as $shop)
            <div class="card">
                <img class="card__image" src="{{ $shop->image_url }}" alt="店舗写真">
                <div class="card__contents">
                    <div class="card__name">
                        {{ $shop->name }}
                    </div>
                    <div class="card__hashtag">
                        <span class="card__hashtag--area">#{{ $shop->area['area'] }}</span>
                        <span class="card__hashtag--category">#{{ $shop->category['category'] }}</span>
                    </div>
                    <div class="card__five-point-scale-frame">
                        <span class="card__five-point-scale" style="--score: 2.3"></span>
                    </div>
                    <div class="card__click-contents">
                        <form class="card__detail" action="/detail/{{ $shop->id }}" method="get">
                            @csrf
                            <button class="card__detail-button" type="submit">詳しくみる</button>
                        </form>
                        <form class="card__favorite" action="" method="post">
                            @csrf
                            <button class="card__favorite-button" type="submit">♥</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
