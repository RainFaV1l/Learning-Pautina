@extends('layouts.app-dashboard')

@section('page-title')
    Админ панель
@endsection

@section('content')
    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Добавление заявки</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Страница добавления заявки</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    <div class="admin-panel-info__tables">
                        <div class="admin-panel-info__new-users admin-panel-info-new-users admin-panel-info-users">
                            <div class="admin-panel-info-new-users__container admin-crud">
                                <div class="add-course__form add-course-form">
                                    <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <select wire:model="group_id" name="group_id"
                                                class="add-course-form__input add-course-form__select">
                                            <option value="0" selected disabled>Группы</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('group_id')
                                        {{ $message }}
                                        @enderror
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
@endsection('content')
