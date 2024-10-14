@extends ('layouts/app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/adminpage/shop_register.css') }}">
@endsection

@section ('content')
    <div class="card">
        <div class="card__title">
            Shop Registration
        </div>
        <form class="card__contents" action="/shop/register" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $userId }}">
            <div class="card__contents--input-box-frame">
                <img src="{{ asset('img/restaurant.svg') }}" alt="レストランのアイコン">
                <input class="card__contents--input-box" type="text" name="name" value="{{ old('name') }}" placeholder="Shopname">
                @error ('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="card__contents--select-box-frame">
                <img src="{{ asset('img/area.svg') }}" alt="マップのアイコン">
                <select class="card__contents--select-box" name="area_id">
                    <option selected disabled>Area</option>
                    @foreach ($selectOptions['areas'] as $selectOption)
                        <option value="{{ $selectOption['id'] }}">{{ $selectOption['area'] }}</option>
                    @endforeach
                </select>
                @error ('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="card__contents--select-box-frame">
                <img src="{{ asset('img/genre.svg') }}" alt="タグのアイコン">
                <select class="card__contents--select-box" name="category_id">
                    <option selected disabled>Genre</option>
                    @foreach ($selectOptions['categories'] as $selectOption)
                        <option value="{{ $selectOption['id'] }}">{{ $selectOption['category'] }}</option>
                    @endforeach
                </select>
                @error ('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="card__contents--textarea-box-frame">
                <img src="{{ asset('img/profile.svg') }}" alt="編集のアイコン">
                <textarea class="card__contents--textarea-box" name="profile" placeholder="Profile"></textarea>
                @error ('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="card__contents--file-box-frame">
                <img src="{{ asset('img/image.svg') }}" alt="写真のアイコン">
                <input class="card__contents--file-box" type="file" name="image_url">
                @error ('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button class="card__contents--button-submit" type="submit">登録</button>
        </form>
    </div>
@endsection
