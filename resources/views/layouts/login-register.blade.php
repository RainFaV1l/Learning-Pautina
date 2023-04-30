<!DOCTYPE html>
<html lang="ru">
@include('components.head')
<body>


<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

<div class="wrapper login-register-wrapper">
    <main class="main">
        @yield('login-register-header')
        @yield('content')
    </main>

</div>

</body>
</html>
