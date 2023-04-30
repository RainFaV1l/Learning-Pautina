@extends('layouts.app')

@section('page-title') Каталог курсов @endsection

@section('padding-none') padding-none @endsection

@section('footer-gray-color') footer-gray-color @endsection

@section('content')
    <section class="catalog-banner">
        <div class="container">
            <div class="catalog-banner__wrapper">
                <div class="catalog-banner__info">
                    <div class="catalog-banner__head">
                        <a href="{{ route('index.index') }}">Главная</a>
                        <p>/</p>
                        <a href="{{ route('catalog.index') }}">Каталог</a>
                    </div>
                    <div class="catalog-banner__main">
                        <div class="catalog-banner__title">
                            Каталог курсов
                        </div>
                        <div class="catalog-banner__text">
                            Начни знакомиться с it вместе с нами!
                        </div>
                    </div>
                </div>
                <div class="catalog-banner__img">
                    <img src="{{ asset('assets/img/catalog-banner.png') }}" alt="Изображение баннера">
                </div>
            </div>
        </div>
    </section>
    @livewire('course.course')
@endsection('content')
