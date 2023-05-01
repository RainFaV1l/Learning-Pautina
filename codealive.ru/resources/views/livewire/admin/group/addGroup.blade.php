@extends('layouts.app-dashboard')

@section('page-title') Добавление группы @endsection

@section('content')
    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Добавление группы</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Страница добавления группы</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    <div class="admin-panel-info__tables">
                        <div class="admin-panel-info__new-users admin-panel-info-new-users admin-panel-info-users">
                            <div class="admin-panel-info-new-users__container admin-crud">
                                <div class="add-course__form add-course-form">
                                    <form action="{{ route('groups.store') }}" method="post">
                                        @csrf
                                        <select name="teacher_id" class="add-course-form__input add-course-form__select">
                                            <option value="0" selected disabled>Преподаватель</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher['id'] }}">{{ \App\Models\User::getFioByValue($teacher['surname'], $teacher['name'], $teacher['patronymic']) }}</option>
                                            @endforeach
                                        </select>
                                        @error('course_category_id') {{ $message }} @enderror
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('name') error @enderror">
                                                    <input value="{{ old('name') }}" type="text" name="name" class="input add-course-form__input"
                                                           required autofocus>
                                                    <label for="profile-surname">Название</label>
                                                </div>
                                                @error('name')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
{{--                                        <input type="text" name="name" class="add-course-form__input" placeholder="Название">--}}
{{--                                        @error('name') {{ $message }} @enderror--}}
                                        <div class="add-course-column-button">
                                            <button type="submit" class="button">Добавить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    <section class="admin-panel panel">--}}
{{--        <div class="container">--}}
{{--            <div class="content">--}}
{{--                <div class="title-two">--}}
{{--                    <div class="text">--}}
{{--                        <h1>Добавление группы</h1>--}}
{{--                        <p>Страница добавления группы</p>--}}
{{--                    </div>--}}
{{--                    <div class="line"></div>--}}
{{--                </div>--}}
{{--                <div class="add-course__form add-course-form">--}}
{{--                    <form action="{{ route('groups.store') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <select name="teacher_id" class="add-course-form__input add-course-form__select">--}}
{{--                            <option value="0" selected disabled>Преподаватель</option>--}}
{{--                            @foreach($teachers as $teacher)--}}
{{--                                <option value="{{ $teacher['id'] }}">{{ \App\Models\User::getFioByValue($teacher['surname'], $teacher['name'], $teacher['patronymic']) }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('course_category_id') {{ $message }} @enderror--}}
{{--                        <input type="text" name="name" class="add-course-form__input" placeholder="Название">--}}
{{--                        @error('name') {{ $message }} @enderror--}}
{{--                        <div class="add-course-column-button">--}}
{{--                            <button type="submit" class="button">Добавить</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection('content')
