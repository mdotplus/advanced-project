@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section ('content')
    <div class="contents">
        <div class="contents__left">
            <div class="shop">
                <div class="title-group">
                    <a class="button-back" href="/{{ $redirectPath }}">
                        <img class="button-back__image" src="{{ asset('img/arrow-back.svg') }}" alt="back">
                    </a>
                    <div class="shop__name">{{ $shop->name }}</div>
                </div>
                <img class="shop__image" src="{{ $shop->image_url }}" alt="店舗写真">
                <div class="shop__hashtag">
                    <span class="shop__hashtag--area">#{{ $shop->area['area'] }}</span>
                    <span class="shop__hashtag--category">#{{ $shop->category['category'] }}</span>
                </div>
                <p class="shop__profile">{{ $shop->profile }}</p>
            </div>

            <div class="reviews">
                <div class="reviews__total-point">
                    <div class="reviews__total-point--title">
                        総合評価
                    </div>
                    <div class="reviews__total-point--frame">
                        <div
                            class="reviews__total-point-star"
                            style="--point: {{ empty($reviewPoints[$shop->id]['average']) ? 0 : $reviewPoints[$shop->id]['average'] }}"
                        >
                        </div>
                        <div class="reviews__total-point-number">
                            @if (empty($reviewPoints[$shop->id]))
                                <span class="reviews__total-point-number--no-review">まだレビューがありません</sapn>
                            @else
                                <span class="reviews__total-point-number--average">{{ $reviewPoints[$shop->id]['average'] }} 点</sapn>
                                <span class="reviews__total-point-number--count">( 全 {{ $reviewPoints[$shop->id]['count'] }} 件 )</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="reviews__each-review">
                    @foreach ($reviews as $review)
                        <div class="reviews__each-review--frame">
                            <div class="reviews__each-review--user-name">
                                {{ $review->reservation->user->name }}<span class="reviews__each-review--user-name-suffix"> さん</span>
                            </div>
                            <div class="reviews__each-review--inner-frame">
                                <div class="reviews__each-review--five-point-scale-frame">
                                    <div
                                        class="reviews__each-review-star"
                                        style="--point: {{ empty($review->five_point_scale) ? 0 : $review->five_point_scale }}"
                                    >
                                    </div>
                                    <div class="reviews__each-review-number">
                                        <div class="reviews__each-review--point">{{ $review->five_point_scale }} 点</div>
                                    </div>
                                </div>
                                <div class="reviews__each-review--date">{{ $review->reservation->date }} 訪店</div>
                            </div>
                            <div class="reviews__each-review--comment">{{ $review->comment }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="contents__right">
            <form class="reservation" action="/reservation" method="post">
                @csrf
                <div class="reservation__title">予約</div>
                <div class="reservation__input-contents">
                    <input name="user_id" value="{{ Auth::id() }}" hidden>
                    <input name="shop_id" value="{{ $shop->id }}" hidden>
                    <input class="reservation__date" type="date" name="date" min="" value="{{ old('date') }}">
                    @error ('date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <select class="reservation__time" name="time">
                        <option
                            value=""
                            {{ empty(old('time')) ? 'selected' : '' }}
                            disabled
                        >
                            時間
                        </option>
                        <option value="09:00" {{ old('time') === '09:00' ? 'selected' : '' }}>09:00</option>
                        <option value="09:30" {{ old('time') === '09:30' ? 'selected' : '' }}>09:30</option>
                        <option value="10:00" {{ old('time') === '10:00' ? 'selected' : '' }}>10:00</option>
                        <option value="10:30" {{ old('time') === '10:30' ? 'selected' : '' }}>10:30</option>
                        <option value="11:00" {{ old('time') === '11:00' ? 'selected' : '' }}>11:00</option>
                        <option value="11:30" {{ old('time') === '11:30' ? 'selected' : '' }}>11:30</option>
                        <option value="12:00" {{ old('time') === '12:00' ? 'selected' : '' }}>12:00</option>
                        <option value="12:30" {{ old('time') === '12:30' ? 'selected' : '' }}>12:30</option>
                        <option value="13:00" {{ old('time') === '13:00' ? 'selected' : '' }}>13:00</option>
                        <option value="13:30" {{ old('time') === '13:30' ? 'selected' : '' }}>13:30</option>
                        <option value="14:00" {{ old('time') === '14:00' ? 'selected' : '' }}>14:00</option>
                        <option value="14:30" {{ old('time') === '14:30' ? 'selected' : '' }}>14:30</option>
                        <option value="15:00" {{ old('time') === '15:00' ? 'selected' : '' }}>15:00</option>
                        <option value="15:30" {{ old('time') === '15:30' ? 'selected' : '' }}>15:30</option>
                        <option value="16:00" {{ old('time') === '16:00' ? 'selected' : '' }}>16:00</option>
                        <option value="16:30" {{ old('time') === '16:30' ? 'selected' : '' }}>16:30</option>
                        <option value="17:00" {{ old('time') === '17:00' ? 'selected' : '' }}>17:00</option>
                        <option value="17:30" {{ old('time') === '17:30' ? 'selected' : '' }}>17:30</option>
                        <option value="18:00" {{ old('time') === '18:00' ? 'selected' : '' }}>18:00</option>
                        <option value="18:30" {{ old('time') === '18:30' ? 'selected' : '' }}>18:30</option>
                        <option value="19:00" {{ old('time') === '19:00' ? 'selected' : '' }}>19:00</option>
                        <option value="19:30" {{ old('time') === '19:30' ? 'selected' : '' }}>19:30</option>
                        <option value="20:00" {{ old('time') === '20:00' ? 'selected' : '' }}>20:00</option>
                        <option value="20:30" {{ old('time') === '20:30' ? 'selected' : '' }}>20:30</option>
                        <option value="21:00" {{ old('time') === '21:00' ? 'selected' : '' }}>21:00</option>
                    </select>
                    @error ('time')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <select class="reservation__number" name="number">
                        <option
                            value=""
                            {{ empty(old('number')) ? 'selected' : '' }}
                            disabled
                        >
                            人数
                        </option>
                        <option value=1 {{ old('number') == 1 ? 'selected' : '' }}>1人</option>
                        <option value=2 {{ old('number') == 2 ? 'selected' : '' }}>2人</option>
                        <option value=3 {{ old('number') == 3 ? 'selected' : '' }}>3人</option>
                        <option value=4 {{ old('number') == 4 ? 'selected' : '' }}>4人</option>
                        <option value=5 {{ old('number') == 5 ? 'selected' : '' }}>5人</option>
                        <option value=6 {{ old('number') == 6 ? 'selected' : '' }}>6人</option>
                        <option value=7 {{ old('number') == 7 ? 'selected' : '' }}>7人</option>
                        <option value=8 {{ old('number') == 8 ? 'selected' : '' }}>8人</option>
                        <option value=9 {{ old('number') == 9 ? 'selected' : '' }}>9人</option>
                        <option value=10 {{ old('number') == 10 ? 'selected' : '' }}>10人</option>
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
                        <span>{{ $shop->name }}</span>
                        <span class="reservation__summary--contents-date">-</span>
                        <span class="reservation__summary--contents-time">-</span>
                        <span class="reservation__summary--contents-number">-</span>
                    </div>
                </div>
                <button class="reservation__button" type="submit">予約する</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('/js/detail.js') }}"></script>
@endsection
