<!DOCTYPE html>
<html lang="ru">

@include('components.head')
<!-- Подключение модальных окон -->
@include('livewire.modals.course-subscribe-auth-modal')
@include('livewire.modals.course-subscribe-error-modal')

<body class="@yield('grey-bg')">

    @include('livewire.modals.burger-modal')

    <!--Фон для меню-->
    <div class="bg-black"></div>

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="wrapper">

        <div class="main-section @yield('gray-main-section') @yield('padding-none')">
            @include('components.header')
            @yield('banner')
        </div>

        <main class="main">
            @yield('content')
        </main>

        <footer class="footer-component element-animation opacity-anim @yield('footer-gray-color')">
            @include('components.footer')
        </footer>
    </div>

</body>

</html>
