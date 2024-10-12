@section ('css')
    <link rel="stylesheet" href="{{ asset('css/adminpage/user_management.css') }}">
@endsection

@section ('content')
    <div class="title-group">
        <div class="title-group__left">
            <div class="title-group__title">ユーザー管理</div>
        </div>
        <div class="title-group__right">
            <div class="title-group__search-box">
                <select class="title-group__search-box--authority">
                    <option value="All authority" selected>All authority</option>
                    @foreach ($authorities as $authority)
                        <option value="{{ $authority->authority }}">{{ $authority->authority }}</option>
                    @endforeach
                </select>
                <input class="title-group__search-box--keyword" placeholder="Search ...">
            </div>
        </div>
    </div>
    <div class="user-cards">
        @foreach ($users as $user)
            <div class="user-card-frame user-card-{{ $user->id }}">
                <div class="user-card">
                    <div class="user-card__id" hidden>{{ $user->id }}</div>
                    <div class="user-card__name">
                        <img class="user-card__name--image" src="img/person-white.svg" alt="人のアイコン">
                        <span class="user-card__name--element">{{ $user->name }}</span>
                    </div>
                    <div class="user-card__email">
                        <img class="user-card__email--image" src="img/email-white.svg" alt="メールのアイコン">
                        <span class="user-card__email--element">{{ $user->email }}</span>
                    </div>
                    <div class="user-card__authority">
                        <img class="user-card__authority--image" src="img/flag-white.svg" alt="旗のアイコン">
                        <span class="user-card__authority--element">{{ $user->authority->authority }}</span>
                    </div>
                </div>
                <div class="edit-menu">
                    @unless ($user->id === 1 && $user->authority->authority === '管理者')
                        <button
                            class="edit-menu__modify-button"
                            value="{{ $user->id }},{{ $user->name }},{{ $user->email }},{{ $user->authority->getPlainAuthority() }}"
                            type="button"
                        >
                            編集する
                        </button>
                        <button
                            class="edit-menu__delete-button"
                            type="button"
                        >
                            削除する
                        </button>
                    @endunless
                </div>
            </div>
        @endforeach
    </div>
    {{ $users->links() }}
    <div class="user-modal__background">
        <div class="user-modal__contents-frame">
            <button class="user-modal__contents--button-close">
                <img class="user-modal__contents--image-close" src="{{ asset('img/menu-close.png') }}" alt="close">
            </button>
            <form class="user-modal__contents--items" action="/adminpage/update" method="post">
                @csrf
                <input class="user-modal__contents--items-user-id" type="hidden" name="user_id" value="">
                <div class="user-modal__contents--items-name-frame">
                    <img class="user-modal__contents--items-name-image" src="img/person-blue.svg" alt="人のアイコン">
                    <span class="user-modal__contents--items-name"></span>
                </div>
                <div class="user-modal__contents--items-email-frame">
                    <img class="user-modal__contents--items-email--image" src="img/email-blue.svg" alt="メールのアイコン">
                    <span class="user-modal__contents--items-email"></span>
                </div>
                <div class="user-modal__contents--items-authority-frame">
                    <img class="user-modal__contents--items-authority--image" src="img/flag-blue.svg" alt="旗のアイコン">
                    <select class="user-modal__contents--items-authority" name="authority_id">
                        <option value=1>管理者</option>
                        <option value=2>店舗代表者</option>
                        <option value=3>利用者</option>
                    </select>
                </div>
                <button class="user-modal__contents--items-button" type="submit">保存する</button>
            </form>
        </div>
    </div>
    <hr class="border-line">
    <script src="{{ asset('/js/user_management_search.js') }}"></script>
    <script src="{{ asset('/js/user_management_modal.js') }}"></script>
@endsection
