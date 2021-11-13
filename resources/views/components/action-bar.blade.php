<aside class="action-bar" id = "action_bar">
    <div class="action-bar__logo">
        <img class="logo" src= {{ asset("/images/assets/logo.png") }} alt="">
    </div>
    <div class="action-bar__user-block">
        @auth('web')
            <?php
                $user = auth()->user();
            ?>
            <div class="user">
                <div class="user__contain">
                    <div class="user__avatar">
                        <img src={{$user->image ? asset("/images/users/".$user->image) : asset("/images/users/default-user-image.png")}} id="action_user-image" class="user__avatar-img" alt="">
                    </div>
                </div>
            </div>
            <div class="action-bar__user-panel">
                <span class="action-bar__nickname">{{$user->name}}</span>
                <a href={{route("users.show", ["user"=> $user->name])}} class="action-bar__account">Профиль</a>
                <a href={{route("logout")}} class="action-bar__account">Выйти</a>
            </div>
        @endauth
        @guest('web')
            <button class="btn login-btn modal-activated" data-modal-id = "#auth_modal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Войти
            </button>
        @endguest
    </div>

    <div class="action-bar__menu">
        <div class="action-bar__list">
            <ul>
                @can('admin', App\Models\User::class)
                    <a href="{{ route("admin.index") }}">
                        <li class= "action-bar__item">Админ панель</li>
                    </a>
                @endcan
                @foreach ($menu as $item)
                    <a href={{ route($item['route']) }}>
                        <li class= "action-bar__item @if($item["active"]) action-bar__item_active @endif">{{$item['title']}}</li>
                    </a>
                @endforeach
            </ul>
        </div>
        <a href="https://www.donationalerts.com/r/shiroikitsune" target="_blank">
            <button class="action-bar__btn btn">Поддержать&nbspпроект</button>
        </a>

        <div class="action-bar__social-links">
            <a href="https://vk.com/shiroi_kitsune" target="_blank">
                <div class="action-bar__link">
                    <img src= {{ asset("/images/assets/vk-logo.png") }} alt="">
                </div>
            </a>
            <a href="https://www.youtube.com/channel/UCrDTOgIDkk9Lqynpj220WfQ" target="_blank">
                <div class="action-bar__link">
                    <img src={{ asset("/images/assets/youtube-logo.png") }} alt="">
                </div>
            </a>
            <a href="https://discord.gg/ZxkcwkNUXf" target="_blank">
                <div class="action-bar__link">
                    <img src= {{ asset("/images/assets/discord.png") }} alt="">
                </div>
            </a>
        </div>
    </div>
</aside>

<div class="modal" id = "auth_modal">
    <div class="modal__content auth-block">
        <div class="auth-block__panel tab">
            <div class="auth-block__item tab__item tab__item_active">
                Авторизация
            </div>
            <div class="auth-block__item tab__item">
                Регистрация
            </div>
        </div>
        <div class="auth-block__forms">
            <form action={{ route('auth') }} method="POST" id = "auth" class="auth-block__form tab__content tab__content_active auth">
                @csrf
                <h2 class="auth-block__title">
                    Авторизация
                </h2>
                <p class="auth-block__error" id = "auth_error"></p>
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "email" id = "auth_email" type="email" autocomplete="off" placeholder="Адрес электроной почты">
                </div>
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "password" id = "auth_password" type="password"  placeholder="Пароль">
                </div>
                <div class="auth-block__field">
                    <label class="auth-block__label checkbox" for="show_password">
                        <input class="checkbox__check" id = "show_password" type="checkbox">
                        <span class="checkbox__checkmark"></span>
                        Показать пароль
                    </label>
                </div>
                <div class="auth-block__submit-container">
                    <button class="auth-block__btn btn" type="submit" name = "auth_submit" id = "auth_submit">Войти</button>
                    <div class="loadingio-spinner-rolling-x7mx7r84xh">
                        <div class="ldio-gzftnac7v0p">
                            <div></div>
                        </div>
                    </div>
                    <div class="auth-block__preloader preloader"><div class="preloader__block">
                        <div class="preloader__spin"></div>
                        </div>
                    </div>
                </div>
                <div class="auth-block__forget">
                    <a class="link" href={{ route('forget') }}>
                        Восстановить пароль
                    </a>
                </div>
            </form>
            <form action={{ route('register') }} method="POST" class="auth-block__form tab__content" id = "register">
                @csrf
                <h2 class="auth-block__title">
                    Регистрация
                </h2>
                <p class="auth-block__error" id = "register_error"></p>
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "name" type="text" autocomplete="off" placeholder="Имя">
                </div>
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "email" type="email" autocomplete="off"  placeholder="Адрес электроной почты">
                </div>
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "password" type="password"  placeholder="Пароль">
                </div>
                <div class="auth-block__field">
                    <input class="auth-block__input input" name = "password_confirmation" type="password"  placeholder="Повторите пароль">
                </div>
                <div class="auth-block__submit-container">
                    <button class="auth-block__btn btn" type="submit" name = "auth_submit" id = "register_submit">Зарегистрироваться</button>
                    <div class="auth-block__preloader preloader"><div class="preloader__block">
                        <div class="preloader__spin"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id = "black-action"></div>

<nav class="navbar">
    <div class="navbar__content active" id = "nav_content">
        <div class="navbar__left">
            <button class="navbar__menu-btn menu-btn" id = "nav_btn">
                <i class="navbar__humburger humburger"></i>
            </button>
            <a href="{{ route("index") }}">
                <div class="navbar__logo-container">
                    <img class="navbar__logo" src="{{ asset("/images/assets/nav_logo.png") }}" alt="">
                </div>
            </a>
        </div>
        <div class="navbar__right">
            <button class="navbar__menu-btn" id = "nav_search_btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" fill="none" class="h-8 w-8" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="navbar__search-panel" id = "nav_search_panel">
        <button class="navbar__menu-btn" id = "nav_back_btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </button>
        <form action="{{ route("releases.index") }}" method="GET" class="navbar__search search">
            <button class="navbar__search-btn search__btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-8 w-8" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            <input type="text" name="search" class="navbar__search search__input input" id = "nav_search" placeholder="Поиск" autocomplete="off" data-list-search = "#search_list2">
            <div class="search__list" id = "search_list2"></div>
        </form>
    </div>
</nav>