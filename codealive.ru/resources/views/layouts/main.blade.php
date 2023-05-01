<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title')</title>
    <link rel="shortcut icon" href="{{asset('assets/img/favicon/favicon.svg')}}" type="image/svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js" integrity="sha256-huW7yWl7tNfP7lGk46XE+Sp0nCotjzYodhVKlwaNeco=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/index.js')}}" defer></script>
    <script src="{{asset('assets/js/slider.js')}}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="{{asset('assets/scss/style.scss')}}">
{{--    @vite(['public/assets/scss/style.scss', 'public/assets/css/style.css'], 'assets/js/index.js')--}}
    @vite(['public/assets/scss/style.scss'], 'assets/js/index.js')
</head>

<body class="@yield('grey-bg')">

<!--Фон для меню-->
<div class="bg-black"></div>

<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

<div class="wrapper">
    <div class="main-section @yield('gray-main-section')">
        @include('components.header')
        @yield('banner')
    </div>

    <main class="main">
        @yield('content')
    </main>

    @include('components.footer')

</div>

</body>
</html>
