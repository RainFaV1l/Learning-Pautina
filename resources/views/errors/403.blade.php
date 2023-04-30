@extends('layouts.app')

@section('page-title')
    403
@endsection

@section('content')
    <section class="error-page">
        <div class="error-page__container container">
            <div class="error-page__column">
                <div class="error-page__icon">
                    <img src="{{ asset('assets/img/403.svg') }}" alt="icon">
                </div>
                <div class="error-page__content">
                    <div class="error-page__text">
                        <h2 class="error-page__title">Доступ запрещен</h2>
                        <p class="error-page__subtitle">Доступ к страница, на которую вы пытаетесь перейти, запрещён. У вас
                            нет прав доступа.</p>
                    </div>
                    <a href="{{ route('index.index') }}" class="error-page__button button">На главную</a>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
