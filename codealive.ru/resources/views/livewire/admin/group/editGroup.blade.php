@extends('layouts.app-dashboard')

@section('page-title') Редактирование группы @endsection

@section('content')
    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Редактирование группы</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Страница редактирования группы</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    <div class="add-course__form add-course-form">
                        <div class="admin-panel-info__tables">
                            <div class="admin-panel-info__new-users admin-panel-info-new-users admin-panel-info-users">
                                <div class="admin-panel-info-new-users__container admin-crud">
                                    <div class="add-course__form add-course-form">
                                        <form action="{{ route('groups.update', $group) }}" method="post">
                                            @csrf
                                            <select name="teacher_id" class="add-course-form__input add-course-form__select">
                                                <option value="0" selected disabled>Преподаватель</option>
                                                @foreach($teachers as $teacher)
                                                    <option
                                                        @if($group->teacher_id === $teacher['id'])
                                                        selected
                                                        @endif
                                                        value="{{ $teacher['id'] }}">{{ \App\Models\User::getFioByValue($teacher['surname'], $teacher['name'], $teacher['patronymic']) }}</option>
                                                @endforeach
                                            </select>
                                            @error('course_category_id') {{ $message }} @enderror
                                            <input type="text" name="name" class="add-course-form__input" placeholder="Название" value="{{ $group['name'] }}">
                                            @error('name') {{ $message }} @enderror
                                            <div class="add-course-column-button">
                                                <button type="submit" class="button">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
