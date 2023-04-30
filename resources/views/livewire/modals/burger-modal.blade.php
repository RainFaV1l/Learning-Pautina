<!--Мобильное меню-->
<div class="modal-burger">
    <div class="content">
        <div class="modal-burger__title">
            <h2>Меню</h2>
            <div class="close">
                <svg width="25" height="17" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.85208 0.489342C2.19963 -0.163114 1.14179 -0.163114 0.48934 0.489342C-0.163113 1.1418 -0.163113 2.19964 0.48934 2.85209L10.1373 12.5L0.48944 22.1479C-0.163013 22.8004 -0.163014 23.8582 0.48944 24.5107C1.14189 25.1631 2.19973 25.1631 2.85218 24.5107L12.5 14.8628L22.1478 24.5107C22.8003 25.1631 23.8581 25.1631 24.5106 24.5107C25.163 23.8582 25.163 22.8004 24.5106 22.1479L14.8627 12.5L24.5107 2.85209C25.1631 2.19964 25.1631 1.1418 24.5107 0.489342C23.8582 -0.163114 22.8004 -0.163114 22.1479 0.489342L12.5 10.1373L2.85208 0.489342Z" fill="#1D1D39"/>
                </svg>
            </div>
        </div>
        <div class="modal-burger__wrapper">
            <a href="{{ route('index.index') }}">Главная</a>
            <a href="{{ route('catalog.index') }}">Каталог</a>
            <a href="{{ route('index.benefits') }}">Преимущества</a>
            <a href="{{ route('index.about') }}">О нас</a>
            <a href="{{ route('index.review') }}">Отзывы</a>
            <div class="row">
                @auth
                    <a href="{{ route('logout') }}" class="button-account__modal">Выход</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="button-account__modal">Войти</a>
                    <a href="{{ route('login') }}" class="button-account__modal reg-button">Зарегисрироваться</a>
                @endguest
            </div>
        </div>
    </div>
</div>
