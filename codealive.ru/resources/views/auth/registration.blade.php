@extends('layouts.main')

@section('content')
    <section class="registration">
        <div class="container">
            <div class="reg-wrapper">
                <div class="auth-title">Регистрация</div>
                <div class="account-create">Есть профиль? Скорей <a href="#">авторизуйся!</a></div>
                <form action="{{ route('registration') }}" method="post" class="reg-form">
                    @csrf
                    <input type="text" name="surname" class="input" placeholder="Фамилия" :value="old('email')" required>
                    <input type="text" name="name" class="input" placeholder="Имя" required>
                    <input type="text" name="patronymic" class="input" placeholder="Отчество" required>
                    <input type="date" name="birthday" class="input" placeholder="Дата рождения" required>
                    <input type="text" name="tel" class="input tel" placeholder="Телефон" required>
                    <input type="email" name="email" class="input" placeholder="Email" required>
                    <input type="password" name="password" class="input" placeholder="Пароль" required>
                    <input type="password" name="password_r" class="input" placeholder="Подтвердите пароль" required>
                    <div class="reg__row">
                        <div class="g-recaptcha" data-sitekey="6Ldl6VQkAAAAAONB7z5s0khGvLOxwB-YCmIOA_3t"></div>
                        <div class="check-wrapper">
                            <input type="checkbox" id="check" name="checkbox" required>
                            <label for="check">Согласен на <a href="#">обработку персональных данных</a></label>
                        </div>
                    </div>
                    <button type="submit" class="button small">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </section>
@endsection
