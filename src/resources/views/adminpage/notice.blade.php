@extends ('layouts.app')

@section ('css')
    <link rel="stylesheet" href="{{ asset('css/adminpage/notice.css') }}">
@endsection

@section ('content')
    <div class="title">お知らせ作成</div>
    <form class="notice-form" action="/notice/send" method="post">
        @csrf
        <div class="notice-form__group notice-form__title-group">
            <label for="title">タイトル:</label><br>
            <input class="notice-form__title" id="title" type="text" name="title" value="{{ old('title') }}" placeholder="タイトルを入力してください">
            @error ('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="notice-form__group notice-form__message-group">
            <label for="message">本文:</label><br>
            <textarea class="notice-form__message" id="message" name="message" placeholder="メール本文を入力してください">{{ old('message') }}</textarea>
            @error ('message')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="notice-form__group notice-form__recipient-group">
            <label for="recipient">宛先(複数選択可):</label><br>
            <select class="notice-form__recipient" id="recipient" name="recipients[]" multiple>
                <option
                    value=""
                    {{ empty(old('recipients')) ? 'selected' : '' }}
                    disabled
                >
                    宛先を選択してください
                </option>
                <option
                    value="all"
                    {{ empty(old('recipients')) ? '' : (in_array('all', old('recipients')) ? 'selected' : '') }}
                >
                    全員
                </option>
                @foreach ($recipients as $recipient)
                    <option
                        value="{{ $recipient->email }}"
                        {{ empty(old('recipients')) ? '' : (in_array($recipient->email, old('recipients')) ? 'selected' : '') }}
                    >
                        {{ $recipient->name }} さん
                    </option>
                @endforeach
            </select>
            @error ('recipients')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button class="notice-form__button" type="submit">送信</button>
    </form>
@endsection
