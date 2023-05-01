@extends('layouts.app-dashboard')

@section('page-title') Редактирование категории @endsection

@section('content')
    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Редактирование категории</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Страница редактирования категории</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    <div class="add-course__form add-course-form">
                        <div class="admin-panel-info__tables">
                            <div class="admin-panel-info__new-users admin-panel-info-new-users admin-panel-info-users">
                                <div class="admin-panel-info-new-users__container admin-crud">
                                    <div class="add-course__form add-course-form">
                                        <form action="{{ route('categories.categoryEdit', $category['id']) }}" method="post">
                                            @csrf
                                            <input wire:model="name" value="{{ $category['name'] }}" type="text" name="name" class="add-course-form__input" placeholder="Название">
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
