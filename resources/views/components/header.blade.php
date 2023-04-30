<header class="opacity-anim element-animation">
    <div class="container">
        <div class="head">
            <div class="logo">
                <a href="{{ route('index.index') }}">
                    Паутина
                </a>
            </div>
            <div class="nav">
                <a href="{{ route('index.index') }}"
                    class="nav__a {{ \App\Models\Header::isActiveRoute('index.index') }}">Главная</a>
                <a href="{{ route('catalog.index') }}"
                    class="nav__a {{ \App\Models\Header::isActiveRoute('catalog.index') }}">Каталог</a>
                <a href="{{ route('index.benefits') }}"
                    class="nav__a {{ \App\Models\Header::isActiveRoute('index.benefits') }}">Преимущества</a>
                <a href="{{ route('index.about') }}"
                    class="nav__a {{ \App\Models\Header::isActiveRoute('index.about') }}">О нас</a>
                <a href="{{ route('index.review') }}"
                    class="nav__a {{ \App\Models\Header::isActiveRoute('index.review') }}">Отзывы</a>
            </div>
            @auth
                <div class="account">
                    <div class="account-wrapper">
                        <div data-turbolinks-permanent class="name">
                            <div class="arrow">
                                <img src="{{ asset('assets/img/arrow.png') }}" alt="icon">
                            </div>
                            <p>
                                {{ \App\Models\User::getFIO() }}
                            </p>
                            <div class="ava">
                                @if (\Illuminate\Support\Facades\Auth::user()->profile_photo_path)
                                    <img src="{{ asset(\App\Models\User::userFind(\Illuminate\Support\Facades\Auth::user()->id)->user_url) }}"
                                        alt="avatar">
                                @else
                                    <img src="{{ asset('assets/img/gamer.png') }}" alt="avatar">
                                @endif

                            </div>
                        </div>
                        <div class="menu">
                            <a href="{{ route('index.index') }}"
                                class="{{ \App\Models\Header::isActiveRoute('index.index') }}">Главная</a>
                            <a href="{{ route('profile.index') }}"
                                class="{{ \App\Models\Header::isActiveRoute('profile.index') }}">Профиль</a>
                            @if (\Illuminate\Support\Facades\Auth::user()->role_id == 3)
                                <a href="{{ route('dashboard.index') }}"
                                    class="{{ \App\Models\Header::isActiveRoute('dashboard.index') }}">Админ</a>
                            @endif
                            @if (\Illuminate\Support\Facades\Auth::user()->role_id == 3 or \Illuminate\Support\Facades\Auth::user()->role_id == 2)
                                <a href="{{ route('teacher-panel.courses') }}"
                                   class="{{ \App\Models\Header::isActiveRoute('teacher-panel.courses') }}">Панель преподавателя</a>
                            @endif
                            @if (\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                                <a href="{{ route('courses.index') }}"
                                    class="{{ \App\Models\Header::isActiveRoute('courses.index') }}">Мои курсы</a>
                                <a href="{{ route('applications.index') }}"
                                    class="{{ \App\Models\Header::isActiveRoute('applications.index') }}">Заявки</a>
                            @endif
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="exit">Выйти</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
            <a class="burger"><img src="{{ asset('assets/img/burger.png') }}" alt="burger"></a>
            @guest
                <a href="{{ route('login') }}" class="button-account">Вход</a>
            @endguest
        </div>
    </div>
</header>
