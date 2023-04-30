@extends('layouts.login-register')

@section('page-title') Регистрация @endsection

@section('content')
    <section class="registration opacity-anim element-animation">
        <div class="container">
            <div class="reg-wrapper">
                <div class="auth-title">Регистрация</div>
                <div class="account-create">Есть профиль? Скорей <a href="{{ route('login') }}">авторизуйся!</a></div>
{{--                <x-jet-validation-errors class="mb-4" />--}}
                <form action="{{ route('register') }}" method="post" class="reg-form" novalidate>
                    @csrf
                    <div class="error__input-column">
                        <div class="input-column @error('surname') error @enderror">
                            <input id="reg-surname" type="text" name="surname" class="input" value="{{old('surname')}}" required autofocus autocomplete="surname">
                            <label for="reg-surname">Фамилия</label>
                        </div>
                        @error('surname')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('name') error @enderror">
                            <input id="reg-name" type="text" name="name" class="input" value="{{old('name')}}" required autofocus autocomplete="name">
                            <label for="reg-name">Имя</label>
                        </div>
                        @error('name')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('patronymic') error @enderror">
                            <input id="reg-patronymic" type="text" name="patronymic" class="input" value="{{old('patronymic')}}" required autofocus autocomplete="patronymic">
                            <label for="reg-patronymic">Отчество</label>
                        </div>
                        @error('patronymic')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('birthday_date') error @enderror">
                            <input id="reg-birthday_date" type="date" name="birthday_date" class="input" value="{{old('birthday_date')}}" required autofocus autocomplete="birthday">
                            <label for="reg-birthday_date">Дата рождения</label>
                        </div>
                        @error('birthday_date')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('tel') error @enderror">
                            <input id="reg-tel" type="text" name="tel" class="input tel" value="{{old('tel')}}" required autofocus autocomplete="tel">
                            <label for="reg-tel">Телефон</label>
                        </div>
                        @error('tel')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('email') error @enderror">
                            <input id="reg-email" type="text" name="email" class="input" value="{{old('email')}}" required autofocus autocomplete="email">
                            <label for="reg-email">Email</label>
                        </div>
                        @error('email')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('password') error @enderror">
                            <input id="reg-password" type="password" name="password" class="input" value="{{old('password')}}" required autocomplete="new-password">
                            <label for="reg-password">Пароль</label>
                        </div>
                        @error('password')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="error__input-column">
                        <div class="input-column @error('password_confirmation') error @enderror">
                            <input id="reg-password_r" type="password" name="password_confirmation" class="input" value="{{old('password_confirmation')}}" required autofocus autocomplete="new-password">
                            <label for="reg-password_r">Подтвердите пароль</label>
                        </div>
                        @error('password_confirmation')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="reg__row">
{{--                        <div class="g-recaptcha" data-sitekey="6Ldl6VQkAAAAAONB7z5s0khGvLOxwB-YCmIOA_3t"></div>--}}
                        <div class="check-wrapper">
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <input type="checkbox" id="check" name="terms" required>
                                <label for="check">
                                    {!! __('Согласен c :terms_of_service и :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('условием использования').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('политикой конфиденциальности').'</a>',
                                    ]) !!};
                                </label>
                                @error('terms')
                                    <div class="input-column-error__text"> {{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="button small">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </section>
@endsection('content')

@section('login-register-header')
    <header class="login-register-header opacity-anim element-animation">
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
                    <a href="{{'login'}}" class="login-register-header__button">Войти</a>
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

{{--        <form method="POST" action="{{ route('register') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-jet-label for="name" value="{{ __('Name') }}" />--}}
{{--                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
{{--                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
{{--            </div>--}}

{{--            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())--}}
{{--                <div class="mt-4">--}}
{{--                    <x-jet-label for="terms">--}}
{{--                        <div class="flex items-center">--}}
{{--                            <x-jet-checkbox name="terms" id="terms" required />--}}

{{--                            <div class="ml-2">--}}
{{--                                {!! __('I agree to the :terms_of_service and :privacy_policy', [--}}
{{--                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',--}}
{{--                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',--}}
{{--                                ]) !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </x-jet-label>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
{{--                    {{ __('Already registered?') }}--}}
{{--                </a>--}}

{{--                <x-jet-button class="ml-4">--}}
{{--                    {{ __('Register') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
