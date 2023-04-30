@extends('layouts.app-dashboard')

@section('page-title') Админ панель @endsection

@section('content')

    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Панель администратора</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Основная информация и статистика</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    @livewire('dashboard.dashboard-infographic')
                    <div class="admin-panel-info__tables">
                        <div class="admin-panel-info__new-users admin-panel-info-new-users admin-panel-info-new-groups">
                            <div class="admin-panel-info-new-users__container">
                                <div class="admin-panel-info-new-users__header">
                                    <h3 class="admin-panel-info-new-users__title">Новые группы</h3>
                                    <a class="admin-panel-info-new-users__link" href="{{ route('dashboard.groups') }}">Смотреть все
                                        <span>
                                                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1.75L5.12504 5.87504C5.32846 6.07846 5.31869 6.41117 5.10367 6.6023L1 10.25" stroke="#6C63FF" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </span>
                                    </a>
                                </div>
                                @livewire('dashboard.new-groups')
                            </div>
                        </div>
                        <div class="admin-panel-info__new-groups admin-panel-info-new-groups">
                            <div class="admin-panel-info-new-users__container">
                                <div class="admin-panel-info-new-users__header">
                                    <h3 class="admin-panel-info-new-users__title">Новые пользователи</h3>
                                    <a class="admin-panel-info-new-users__link" href="{{ route('dashboard.users') }}">Смотреть всех
                                        <span>
                                                <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1.75L5.12504 5.87504C5.32846 6.07846 5.31869 6.41117 5.10367 6.6023L1 10.25" stroke="#6C63FF" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </span>
                                    </a>
                                </div>
                                @livewire('dashboard.new-users')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection('content')
