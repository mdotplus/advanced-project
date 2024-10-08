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
                    @unless ($user->authority->authority === '管理者')
                        <form class="edit-menu__modify" action="" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button class="edit-menu__modify-button" type="submit">編集する</button>
                        </form>
                        <form class="edit-menu__delete" action="" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button class="edit-menu__delete-button" type="submit">削除する</button>
                        </form>
                    @endunless
                </div>
            </div>
        @endforeach
    </div>
    {{ $users->links() }}
    <hr class="border-line">
    <script src="{{ asset('/js/user_management.js') }}"></script>
@endsection
