@extends('layouts.login-register')

@section('page-title') Авторизация @endsection

@section('content')
    <section class="auth">
        <div class="auth-wrapper">
            <div class="auth__img">
                <img src="{{asset('assets/img/auth.png')}}" alt="img" class="element-animation img-anim">
            </div>
            <div class="auth__info element-animation opacity-anim">
                <div class="auth-title">Вход</div>
                <div class="account-create">Нет профиля? Скорей <a href="{{route('register')}}">создавай</a>, это бесплатно!</div>
{{--                <x-jet-validation-errors class="mb-4" />--}}
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="error__input-column">
                        <div class="input-column @error('email') error @enderror">
                            <input class="input" id="auth-email" type="text" name="email" value="{{old('email')}}" required autofocus>
                            <label for="auth-email">Email</label>
                        </div>
                        @error('email')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="error__input-column">
                        <div class="input-column @error('email') error @enderror">
                            <input type="password" id="auth-password" name="password" class="input" required autocomplete="current-password">
                            <label for="auth-password">Пароль</label>
                        </div>
                        @error('password')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>

                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Забыли пароль?</a>
                    @endif
                    <button class="button">Войти</button>
                </form>
            </div>
        </div>
    </section>
@endsection('content')

@section('login-register-header')
    <header class="login-register-header element-animation opacity-anim">
        <div class="login-register-header__container container">
            <div class="login-register-row">
                <div class="login-register-header__logo">
                    <div class="logo">
                        <a href="{{ route('index.index') }}">
                            Паутина
                        </a>
                    </div>
                </div>
                <div class="login-register-header__buttons">
                    <a href="{{'register'}}" class="login-register-header__button">Создать</a>
                </div>
            </div>
        </div>
    </header>
@endsection('login-register-header')

{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        @if (session('status'))--}}
{{--            <div class="mb-4 font-medium text-sm text-green-600">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form method="POST" novalidate action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-jet-button class="ml-4">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
