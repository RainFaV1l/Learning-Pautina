<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title')</title>
{{--        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>--}}
    <link data-turbo-track="reload" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.svg') }}"
        type="image/svg">
    <link data-turbo-track="reload" rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <script data-turbo-track="reload" src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script data-turbo-track="reload" src="https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js"
        integrity="sha256-huW7yWl7tNfP7lGk46XE+Sp0nCotjzYodhVKlwaNeco=" crossorigin="anonymous"></script>
    <link data-turbo-track="reload" rel="preconnect" href="https://fonts.googleapis.com">
    <link data-turbo-track="reload" rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link data-turbo-track="reload" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link data-turbo-track="reload" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link data-turbolinks-track="reload" rel="stylesheet" href="{{ asset('build/assets/style-bc7cf69f.css') }}">
    <script data-turbolinks-track="reload" src="{{ asset('build/assets/app-f25b4258.js') }}" defer></script>
{{--    @vite(['resources/js/app.js'])
    @vite(['resources/scss/style.scss'], 'resources/js/app.js') --}}

     @livewireStyles
     @livewireScripts
    {{-- @livewire('livewire-ui-modal') --}}

</head>
