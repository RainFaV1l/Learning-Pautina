@extends('layouts.app')

@section('page-title') {{ $course->name }} @endsection

@section('footer-gray-color') footer-gray-color @endsection

@section('content')
    <section class="direction-banner">
        <div class="container">
            <div class="direction-banner__wrapper">
                <div class="direction-banner__head">
                    <a href="{{ route('index.index') }}">Главная</a>
                    <p>/</p>
                    <a href="{{ route('catalog.index') }}">Каталог</a>
                    <p>/</p>
                    <a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $course['id']) }}">{{ $course->name }}</a>
                </div>
                <div class="direction-banner__main">
                    <div class="direction-banner__info">
                        <div class="direction-title-text">
                            <div class="direction-banner__title">
                                {{ $course->name }}
                            </div>
                            <div class="direction-banner__text">
                                {{ $course->description }}
                            </div>
                        </div>
                        @auth
                            @if(\Illuminate\Support\Facades\Auth::user()->role_id === 1)
                                @if(\App\Models\CourseUser::checkSubscribe($course->id))
                                    <button class="button subscribe-course-error-modal-button">Записаться</button>
                                @else
                                    @livewire('course.course-subscribe', ['course_id' => $course['id']])
                                @endif
                            @endif
                        @endauth
                        @guest()
                            <button class="button guest-subscribe-course-modal-button">Записаться</button>
                        @endguest
                    </div>
                    <div class="direction-banner__img">
                        <img src="{{ $course->icon_url }}" alt="Иконка баннера">
                    </div>
                </div>
                <div class="direction-banner__end">
                    <div class="direction-banner__lessons">
                        <p>Уровень - {{ $course->level['name'] }}</p>
                        <p>Категория - {{ $course->category['name'] }}</p>
                        <p>{{ \App\Models\CourseUser::formatLessonsCount($allLessonsCount) }}</p>
                    </div>
                    <div class="direction-banner__creator">
                        Автор курса:
                        {{ \App\Models\User::getFioShort($course->user->surname, $course->user->name, $course->user->patronymic) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="proposal">
        <div class="container">
            <div class="title">
                <h2>Что мы предлагаем?</h2>
                <div class="line"></div>
            </div>
            <div class="proposal-wrapper">
                <div class="proposal__item">
                    <div class="img">
                        <img src="{{ asset('assets/img/p1.png') }}" alt="Преимущество 1">
                    </div>
                    <div class="proposal__title-text">
                        <h3>Работа с куратором</h3>
                        <p>Курсы предусматривают очные встречи с куратороми для объяснения темы</p>
                    </div>
                </div>
                <div class="proposal__item">
                    <div class="img">
                        <img src="{{ asset('assets/img/p2.png') }}" alt="Преимущество 2">
                    </div>
                    <div class="proposal__title-text">
                        <h3>Открытый доступ</h3>
                        <p>Мы гарантируем неограниченный доступ к купленным вами курсам.</p>
                    </div>
                </div>
                <div class="proposal__item">
                    <div class="img">
                        <img src="{{ asset('assets/img/p3.png') }}" alt="Преимущество 3">
                    </div>
                    <div class="proposal__title-text">
                        <h3>Много практики</h3>
                        <p>Мы используем практический метод обучения. Меньше лекций, больше практики!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how">
        <div class="container">
            <div class="title">
                <h2>Как проходит обучение?</h2>
                <div class="line line1"></div>
            </div>
            <div class="how-wrapper">
                <div class="how__info">
                    <div class="how__item">
                        <div class="number">
                            01
                        </div>
                        <div class="proposal__title-text">
                            <h3>Выбрать направление</h3>
                            <p>Во первых, необходимо определиться с выбором направления. Это можно сделать
                                самостоятельно в сети интернет или обратиться к нашим специалистам.
                            </p>
                        </div>
                    </div>
                    <div class="how__item">
                        <div class="number">
                            02
                        </div>
                        <div class="proposal__title-text">
                            <h3>Авторизоваться</h3>
                            <p>Для записи на курс необходиом авторизоваться на сайте. Авторизация проходит наиболее
                                удобным для пользователя образом.
                            </p>
                        </div>
                    </div>
                    <div class="how__item">
                        <div class="number">
                            03
                        </div>
                        <div class="proposal__title-text">
                            <h3>Подать заявку</h3>
                            <p>Для выбора направления необходимо подать заявку, заполнив форму подачи заявки некоторыми
                                данными и подождать одобрение заявки.
                            </p>
                        </div>
                    </div>
                    <div class="how__item">
                        <div class="number">
                            04
                        </div>
                        <div class="proposal__title-text">
                            <h3>Начать обучение</h3>
                            <p>Остается только просмотреть курс и решить задачи, которые максимально близки к реальным
                                задачам и загрузить решения на сервер.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="how__img">
                    <img src="{{ asset('assets/img/how.png') }}" alt="Как начать обучение?">
                </div>
            </div>
        </div>
    </section>
    <section class="program">
        <div class="container">
            <div class="title">
                <h2>Программа обучения</h2>
                <div class="line"></div>
            </div>
            <div class="program-lessons">
                <p><span>{{ $allLessonsCount }}</span> {{ \App\Models\CourseUser::formatLessonsCount($allLessonsCount, true) }}</p>
                <p><span>{{ $course_modules->count() }}</span> {{ \App\Models\CourseUser::formatLessonsCount($course_modules->count(), true, true) }} </p>
                {{-- <p><span>2</span> очных занятия</p> --}}
            </div>
            <div class="program-themes">
                @foreach ($course_modules as $course_module)
                    <div class="module-lessons-title">
                        <h3 class="module-name">Модуль {{ $course_module->module_number }}</h3>
                        @php
                            $module_lessons = \App\Models\LessonModule::query()
                            ->select('lessons.id', 'lessons.name',
                            'lessons.description', 'lessons.task', 'lessons.lesson_number')
                            ->join('lessons', 'lesson_modules.lesson_id', 'lessons.id')
                            ->where('lesson_modules.module_id', '=', $course_module->id)
                            ->get();
                        @endphp
                        @foreach($module_lessons as $lesson)
                            <div class="program-themes__item ">
                                <div class="program-themes__wrapper">
                                    <div class="info">
                                        <div class="circle "></div>
                                        <div class="name">{{ $lesson['lesson_number'] . '. ' . $lesson['name'] }}</div>
                                    </div>
                                    <div class="arrow ">
                                        <svg width="20" height="12" viewBox="0 0 20 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.38557 1.22386C2.89539 0.723678 2.08997 0.723751 1.59988 1.22402L1.50696 1.31887C1.03081 1.80492 1.03087 2.58253 1.5071 3.0685L9.08105 10.7975C9.56251 11.2888 10.3505 11.2988 10.8442 10.8199L18.8338 3.06946C19.331 2.58711 19.3411 1.79237 18.8563 1.2975L18.7597 1.1989C18.28 0.709176 17.4953 0.69724 17.0009 1.17214L10.4968 7.41943C10.2002 7.70434 9.72948 7.69722 9.44162 7.40348L3.38557 1.22386Z"
                                                fill="#6C63FF" class="arcol" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="about ">
                                    {{ $lesson['description'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="reviews section-padding">
        <div class="container">
            <div class="title">
                <h2>Отзыв на курс</h2>
                <div class="line line1"></div>
            </div>
            <div class="score">
                <p>Средняя оценка курса 4,4 из 5</p>
                <img src="{{ asset('assets/img/star.svg') }}" alt="Отзыв">
            </div>
        </div>
        <div class="reviews-slider__wrapper">
            <div class="swiper reviews-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="text">
                            “Курс на 100% соответствует своему названию! Я быстро освоил программу, которая раньше
                            своим
                            внешним видом вызывала лишь ужас и полное непонимание. Сама платформа очень удобная,
                            всегда
                            можно задать вопрос. “
                        </div>
                        <div class="user">
                            <div class="ava">
                                <img src="{{ asset('assets/avatar/gamer.png') }}" alt="Аватарка">
                            </div>
                            <div class="name">
                                Громов Владимир
                            </div>
                            <div class="rating">
                                <img src="{{ asset('assets/img/stars.png') }}" alt="Звезда">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="text">
                            “Курс на 100% соответствует своему названию! Я быстро освоил программу, которая раньше
                            своим
                            внешним видом вызывала лишь ужас и полное непонимание. Сама платформа очень удобная,
                            всегда
                            можно задать вопрос. “
                        </div>
                        <div class="user">
                            <div class="ava">
                                <img src="{{ asset('assets/avatar/gamer.png') }}" alt="Аватарка">
                            </div>
                            <div class="name">
                                Иванова Альбина
                            </div>
                            <div class="rating">
                                <img src="{{ asset('assets/img/stars.png') }}" alt="Звезда">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="text">
                            “Курс на 100% соответствует своему названию! Я быстро освоил программу, которая раньше
                            своим
                            внешним видом вызывала лишь ужас и полное непонимание. Сама платформа очень удобная,
                            всегда
                            можно задать вопрос. “
                        </div>
                        <div class="user">
                            <div class="ava">
                                <img src="{{ asset('assets/avatar/gamer.png') }}" alt="Аватарка">
                            </div>
                            <div class="name">
                                Альфис Мусин
                            </div>
                            <div class="rating">
                                <img src="{{ asset('assets/img/stars.png') }}" alt="Звезда">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="text">
                            “Курс на 100% соответствует своему названию! Я быстро освоил программу, которая раньше
                            своим
                            внешним видом вызывала лишь ужас и полное непонимание. Сама платформа очень удобная,
                            всегда
                            можно задать вопрос. “
                        </div>
                        <div class="user">
                            <div class="ava">
                                <img src="{{ asset('assets/avatar/gamer.png') }}" alt="Аватарка">
                            </div>
                            <div class="name">
                                Иванов Алексей
                            </div>
                            <div class="rating">
                                <img src="{{ asset('assets/img/stars.png') }}" alt="Звезда">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slider-buttons">
                    <div class="prev">
                        <img src="{{ asset('assets/img/prev.png') }}" alt="Стрелка">
                    </div>
                    <div class="next">
                        <img src="{{ asset('assets/img/next.png') }}" alt="Стрелка">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="subscribe__now subscribe section-padding">
        <div class="container">
            <div class="subscribe__row">
                <div class="subscribe__column">
                    <div class="subscribe__title-subtitle">
                        <h1 class="subscribe__title">Начни развиваться вместе с нами!</h1>
                        <p class="subscribe__text">Подай заявку и учись вместе с нами! Пройдя курс ты познаешь
                            много новой, полезной и интересной информации.</p>
                    </div>
                    @auth
                        @if(\Illuminate\Support\Facades\Auth::user()->role_id === 1)
                            @if(\App\Models\CourseUser::checkSubscribe($course->id))
                                <button class="button subscribe-course-error-modal-button">Записаться на курс</button>
                            @else
                                @livewire('course.course-subscribe', ['course_id' => $course['id']])
                            @endif
                        @endif
                    @endauth
                    @guest()
                        <button class="button guest-subscribe-course-modal-button">Записаться на курс</button>
                    @endguest
{{--                    <a href="#" class="subscribe__button">Записаться на курс</a>--}}
                </div>
                <div class="subscribe__icon">
                    <img src="{{ asset('assets/img/subscribe.png') }}" alt="icon">
                </div>
            </div>
        </div>
    </section>
@endsection('content')
