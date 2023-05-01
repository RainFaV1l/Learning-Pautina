@extends('layouts.app-dashboard')

@section('page-title')
    Редактирование курса
@endsection

@section('content')
    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Редактирование курса</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Страница редактирования курса</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    @livewire('course.course-update', ['categories' => $categories, 'users' => $users, 'levels' => $levels, 'course_id' => $course_id])
                </div>
            </div>
        </div>
    </section>

{{--    <section class="admin-panel panel">--}}
{{--        <div class="container">--}}
{{--            <div class="content">--}}
{{--                <div class="title-two">--}}
{{--                    <div class="text">--}}
{{--                        <h1>Редактирование курса</h1>--}}
{{--                        <p>Страница редактирования курса</p>--}}
{{--                    </div>--}}
{{--                    <div class="line"></div>--}}
{{--                </div>--}}
{{--                <div class="add-course__form add-course-form">--}}
{{--                    @livewire('course.course-update', ['categories' => $categories, 'users' => $users, 'levels' => $levels, 'course_id' => $course_id])--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

@endsection('content')
