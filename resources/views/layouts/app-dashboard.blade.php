<!DOCTYPE html>
<html lang="ru">

@include('components.head')

<body class="grey">
    <div class="bg-black"></div>
    @include('components.admin-header')
    <main>
        @yield('content')
    </main>
    @include('components.admin-footer')
</body>

</html>
