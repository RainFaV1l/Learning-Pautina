@extends('layouts.app-dashboard')

@section('page-title')
    Редактирование урока
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
                    <div class="add-course__form add-course-form">
                        @livewire('lesson.lesson-update', ['lesson_id' => $lesson_id, 'lesson' => $lesson, 'courses' => $courses])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
