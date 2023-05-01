@extends('layouts.app')

@section('page-title')
    404
@endsection

@section('content')
    <section class="error-page">
        <div class="error-page__container container">
            <div class="error-page__column">
                <div class="error-page__icon">
                    <img src="{{ asset('assets/img/404.svg') }}" alt="icon">
                </div>
                <div class="error-page__content">
                    <div class="error-page__text">
                        <h2 class="error-page__title">Страница не найдена</h2>
                        <p class="error-page__subtitle">Страница, которую вы ищете, была перемещена, удалена, переименована
                            или же никогда не существовала</p>
                    </div>
                    <a href="{{ route('index.index') }}" class="error-page__button button">На главную</a>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
