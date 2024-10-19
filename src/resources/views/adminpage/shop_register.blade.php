@extends ('layouts/app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/adminpage/shop_register.css') }}">
@endsection

@section ('content')
    <div class="card">
        <div class="card__title">
            Shop Registration
        </div>
        <form class="card__contents" action="/shop/register" method="post" enctype="multipart/form-data">
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
                    <option
                        {{ empty(old('area_id')) ? 'selected' : '' }}
                        disabled
                    >
                        Area
                    </option>
                    @foreach ($selectOptions['areas'] as $selectOption)
                        <option
                            value="{{ $selectOption['id'] }}"
                            {{ old('area_id') == $selectOption['id'] ? 'selected' : '' }}
                        >
                            {{ $selectOption['area'] }}
                        </option>
                    @endforeach
                </select>
                @error ('area_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="card__contents--select-box-frame">
                <img src="{{ asset('img/genre.svg') }}" alt="タグのアイコン">
                <select class="card__contents--select-box" name="category_id">
                    <option
                        {{ empty(old('category_id')) ? 'selected' : '' }}
                        disabled
                    >
                        Genre
                    </option>
                    @foreach ($selectOptions['categories'] as $selectOption)
                        <option
                            value="{{ $selectOption['id'] }}"
                            {{ old('category_id') == $selectOption['id'] ? 'selected' : '' }}
                        >
                            {{ $selectOption['category'] }}
                        </option>
                    @endforeach
                </select>
                @error ('category_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="card__contents--textarea-box-frame">
                <img src="{{ asset('img/profile.svg') }}" alt="編集のアイコン">
                <textarea class="card__contents--textarea-box" name="profile" placeholder="Profile">{{ old('profile') }}</textarea>
            </div>
            @error ('profile')
                <div class="error">{{ $message }}</div>
            @enderror
            <div class="card__contents--file-box-frame">
                <img src="{{ asset('img/image.svg') }}" alt="写真のアイコン">
                <input class="card__contents--file-box" type="file" accept=".png, .jpg, .jpeg" name="image">
                <input type="hidden" name="image_url" value="">
            </div>
            @error ('image')
                <div class="error">{{ $message }}</div>
            @enderror
            <button class="card__contents--button-submit" type="submit">登録</button>
        </form>
    </div>
@endsection
