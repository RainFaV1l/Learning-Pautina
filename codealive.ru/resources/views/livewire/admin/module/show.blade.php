<div class="modules-table__container" x-data="{active: 0}" wire:key="{{ time() }}">
    <div class="admin-panel-info-new-users__header">
        <h3 class="admin-panel-info-new-users__title" x-text="active === 0 ? 'Уроки модуля' : 'Пользователи'"></h3>
        <template x-if="active === 0">
            <div>
                @if($active == 'lessons')
                    <form wire:submit.prevent="searchModuleLessons()" class="admin-panel-info-new-users__form">
                        <input wire:model.debounce.500ms="search" type="search" placeholder="Поиск уроков по названию">
                        <button type="submit">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="6.5" cy="6.5" r="5.75" stroke="#1D1D39" stroke-opacity="0.6"
                                        stroke-width="1.5" />
                                <line x1="11.0607" y1="11" x2="16" y2="15.9393" stroke="#1D1D39"
                                      stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        </template>
        <template x-if="active === 1">
            <div>
                @if($active == 'users')
                    <form wire:submit.prevent="getAllUsers()" class="admin-panel-info-new-users__form">
                        <input wire:model.debounce.500ms="search_users" type="search" placeholder="Поиск пользователей">
                        <button type="submit">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="6.5" cy="6.5" r="5.75" stroke="#1D1D39" stroke-opacity="0.6"
                                        stroke-width="1.5" />
                                <line x1="11.0607" y1="11" x2="16" y2="15.9393" stroke="#1D1D39"
                                      stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        </template>
        <div class="admin-panel-info-new-users__buttons">
            <button @click="active = 0" :class="active === 0 ? 'active' : ''" type="button" wire:click.prevent="getAllLessons()" class="admin-panel-info-new-users__button">Уроки</button>
            <button @click="active = 1" :class="active === 1 ? 'active' : ''" type="button" wire:click.prevent="getAllUsers()" href="#" class="admin-panel-info-new-users__button">Пользователи</button>
        </div>
        <template x-if="active === 0">
            <div class="admin-panel-info-new-users__buttons">
                <a href="{{ route('modules.addLesson', $module_id) }}" class="admin-panel-info-groups__button">Добавить урок</a>
            </div>
        </template>
    </div>
    <div class="users-table" :class="active === 0 ? 'module-lessons-table' : 'module-users-table'">
        <div class="admin-panel-info-new-users__table new-users-table">
            <template x-if="active === 0">
                <div class="new-users-table__item new-users-table__header">
                    @if(isset($module_lessons))
                        <p class="new-users-table__name id">id</p>
                        <p class="new-users-table__name module__id">id модуля</p>
                        <p class="new-users-table__name lesson__id">id урока</p>
                        <p class="new-users-table__name lesson__name">Название урока</p>
                        <p class="new-users-table__name lesson__number">Номер урока</p>
                        <p class="new-users-table__name date">Дата изменения</p>
                        <p class="new-users-table__name date">Дата добавления</p>
                        <p class="new-users-table__name admin-control__buttons module-lessons-buttons admin-control__hide">
                            <svg width="23" height="5" viewBox="0 0 23 5" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2.5" cy="2.5" r="2.5" fill="transparent" />
                                <circle cx="11.5" cy="2.5" r="2.5" fill="transparent" />
                                <circle cx="20.5" cy="2.5" r="2.5" fill="transparent" />
                            </svg>
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.5098 3.49116H5.25977C3.1887 3.49116 1.50977 5.17009 1.50977 7.24116V19.7413C1.50977 21.8123 3.1887 23.4913 5.25977 23.4913H17.7598C19.8308 23.4913 21.5098 21.8123 21.5098 19.7413L21.5098 13.4912M7.75977 17.2412L12.3077 16.3248C12.5491 16.2761 12.7708 16.1573 12.9449 15.9831L23.1258 5.79655C23.6139 5.30817 23.6136 4.51651 23.1251 4.02853L20.9684 1.87428C20.48 1.38651 19.6888 1.38684 19.2009 1.87503L9.01889 12.0626C8.84513 12.2364 8.72648 12.4577 8.67779 12.6986L7.75977 17.2412Z"
                                    stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.5 5.625H22.5M8.75 1.875H16.25M10 18.125V10.625M15 18.125V10.625M16.875 23.125H8.125C6.74429 23.125 5.625 22.0057 5.625 20.625L5.05425 6.92704C5.02466 6.21688 5.59239 5.625 6.30317 5.625H18.6968C19.4076 5.625 19.9753 6.21688 19.9457 6.92704L19.375 20.625C19.375 22.0057 18.2557 23.125 16.875 23.125Z"
                                    stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </p>
                    @endif
                </div>
            </template>
            <template x-if="active === 1">
                <div class="new-users-table__item new-users-table__header">
                    @if(isset($group_modules))
                        <p class="new-users-table__name user-module__id">id</p>
                        <p class="new-users-table__name user__id">id <br> пользователя</p>
                        <p class="new-users-table__name module__id">id <br> модуля</p>
                        <p class="new-users-table__name surname">Фамилия</p>
                        <p class="new-users-table__name name">Имя</p>
                        <p class="new-users-table__name patronymic">Отчество</p>
                        <p class="new-users-table__name status">Статус</p>
                        <p class="new-users-table__name date">Дата изменения</p>
                        <p class="new-users-table__name date">Дата добавления</p>
                        <p class="new-users-table__name admin-control__buttons module-users-buttons admin-control__hide">
                            <a wire:click.prevent="accept()">
                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.8639 10.6986L11.9375 16.625L9.91735 14.6049M13.5 1C6.59644 1 1 6.59644 1 13.5C1 20.4036 6.59644 26 13.5 26C20.4036 26 26 20.4036 26 13.5C26 6.59644 20.4036 1 13.5 1Z" stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a wire:click.prevent="reject()">
                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-svg">
                                    <path d="M18.6265 9.78769C19.017 9.39717 19.017 8.764 18.6265 8.37348C18.236 7.98295 17.6028 7.98295 17.2123 8.37348L18.6265 9.78769ZM8.37348 17.2123C7.98295 17.6028 7.98295 18.236 8.37348 18.6265C8.764 19.017 9.39716 19.017 9.78769 18.6265L8.37348 17.2123ZM17.2123 18.6265C17.6028 19.017 18.236 19.017 18.6265 18.6265C19.017 18.236 19.017 17.6028 18.6265 17.2123L17.2123 18.6265ZM9.78769 8.37348C9.39716 7.98295 8.764 7.98295 8.37348 8.37348C7.98295 8.764 7.98295 9.39716 8.37348 9.78769L9.78769 8.37348ZM25 13.5C25 19.8513 19.8513 25 13.5 25V27C20.9558 27 27 20.9558 27 13.5H25ZM13.5 25C7.14873 25 2 19.8513 2 13.5H0C0 20.9558 6.04416 27 13.5 27V25ZM2 13.5C2 7.14873 7.14873 2 13.5 2V0C6.04416 0 0 6.04416 0 13.5H2ZM13.5 2C19.8513 2 25 7.14873 25 13.5H27C27 6.04416 20.9558 0 13.5 0V2ZM17.2123 8.37348L12.7929 12.7929L14.2071 14.2071L18.6265 9.78769L17.2123 8.37348ZM12.7929 12.7929L8.37348 17.2123L9.78769 18.6265L14.2071 14.2071L12.7929 12.7929ZM18.6265 17.2123L14.2071 12.7929L12.7929 14.2071L17.2123 18.6265L18.6265 17.2123ZM14.2071 12.7929L9.78769 8.37348L8.37348 9.78769L12.7929 14.2071L14.2071 12.7929Z" fill="#6C63FF"/>
                                </svg>
                            </a>
                        </p>
                    @endif
                </div>
            </template>
            <template x-if="active === 0">
                <div class="row__items">
                    @if(isset($module_lessons))
                        @foreach ($module_lessons as $moduleLesson)
                            <div class="new-users-table__item new-users-table__header">
                                <p class="new-users-table__name id">id</p>
                                <p class="new-users-table__name module__id">id модуля</p>
                                <p class="new-users-table__name lesson__id">id урока</p>
                                <p class="new-users-table__name lesson__name">Название урока</p>
                                <p class="new-users-table__name lesson__number">Номер урока</p>
                                <p class="new-users-table__name date">Дата изменения</p>
                                <p class="new-users-table__name date">Дата добавления</p>
                                <p class="new-users-table__name admin-control__buttons module-lessons-buttons admin-control__hide">
                                    <svg width="23" height="5" viewBox="0 0 23 5" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="2.5" cy="2.5" r="2.5" fill="transparent" />
                                        <circle cx="11.5" cy="2.5" r="2.5" fill="transparent" />
                                        <circle cx="20.5" cy="2.5" r="2.5" fill="transparent" />
                                    </svg>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.5098 3.49116H5.25977C3.1887 3.49116 1.50977 5.17009 1.50977 7.24116V19.7413C1.50977 21.8123 3.1887 23.4913 5.25977 23.4913H17.7598C19.8308 23.4913 21.5098 21.8123 21.5098 19.7413L21.5098 13.4912M7.75977 17.2412L12.3077 16.3248C12.5491 16.2761 12.7708 16.1573 12.9449 15.9831L23.1258 5.79655C23.6139 5.30817 23.6136 4.51651 23.1251 4.02853L20.9684 1.87428C20.48 1.38651 19.6888 1.38684 19.2009 1.87503L9.01889 12.0626C8.84513 12.2364 8.72648 12.4577 8.67779 12.6986L7.75977 17.2412Z"
                                            stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.5 5.625H22.5M8.75 1.875H16.25M10 18.125V10.625M15 18.125V10.625M16.875 23.125H8.125C6.74429 23.125 5.625 22.0057 5.625 20.625L5.05425 6.92704C5.02466 6.21688 5.59239 5.625 6.30317 5.625H18.6968C19.4076 5.625 19.9753 6.21688 19.9457 6.92704L19.375 20.625C19.375 22.0057 18.2557 23.125 16.875 23.125Z"
                                            stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </p>
                            </div>
                            <div class="new-users-table__item" wire:key="{{ $moduleLesson->id }}">
                                <p class="new-users-table__name id">{{ $moduleLesson['id'] }}</p>
                                <p class="new-users-table__name module__id">{{ $moduleLesson['module_id'] }}</p>
                                <p class="new-users-table__name lesson__id">{{ $moduleLesson['lesson_id'] }}</p>
                                <p class="new-users-table__name lesson__name">{{ $moduleLesson['name'] }}</p>
                                <p class="new-users-table__name lesson__number">{{ $moduleLesson['lesson_number'] }}</p>
                                <p class="new-users-table__name date">{{ $moduleLesson['created_at'] }}</p>
                                <p class="new-users-table__name date">{{ $moduleLesson['updated_at'] }}</p>
                                <p class="new-users-table__name admin-control__buttons module-lessons-buttons">
                                    <a href="{{ route('modules.edit', $moduleLesson['id']) }}">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.5098 3.49116H5.25977C3.1887 3.49116 1.50977 5.17009 1.50977 7.24116V19.7413C1.50977 21.8123 3.1887 23.4913 5.25977 23.4913H17.7598C19.8308 23.4913 21.5098 21.8123 21.5098 19.7413L21.5098 13.4912M7.75977 17.2412L12.3077 16.3248C12.5491 16.2761 12.7708 16.1573 12.9449 15.9831L23.1258 5.79655C23.6139 5.30817 23.6136 4.51651 23.1251 4.02853L20.9684 1.87428C20.48 1.38651 19.6888 1.38684 19.2009 1.87503L9.01889 12.0626C8.84513 12.2364 8.72648 12.4577 8.67779 12.6986L7.75977 17.2412Z"
                                                stroke="#6C63FF" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <button type="button" @click="$wire.destroy('{{ $moduleLesson['id'] }}')">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.5 5.625H22.5M8.75 1.875H16.25M10 18.125V10.625M15 18.125V10.625M16.875 23.125H8.125C6.74429 23.125 5.625 22.0057 5.625 20.625L5.05425 6.92704C5.02466 6.21688 5.59239 5.625 6.30317 5.625H18.6968C19.4076 5.625 19.9753 6.21688 19.9457 6.92704L19.375 20.625C19.375 22.0057 18.2557 23.125 16.875 23.125Z"
                                                stroke="#6C63FF" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </template>
            <template x-if="active === 1">
                <div class="row__items">
                    @if(isset($group_modules))
                        @foreach($group_modules as $index => $group_module)
                            <div wire:key="{{ $group_module->user_id }}">
                                <div class="new-users-table__item new-users-table__header">
                                    <p class="new-users-table__name user-module__id">id</p>
                                    <p class="new-users-table__name user__id">id <br> пользователя</p>
                                    <p class="new-users-table__name module__id">id <br> модуля</p>
                                    <p class="new-users-table__name surname">Фамилия</p>
                                    <p class="new-users-table__name name">Имя</p>
                                    <p class="new-users-table__name patronymic">Отчество</p>
                                    <p class="new-users-table__name status">Статус</p>
                                    <p class="new-users-table__name date">Дата изменения</p>
                                    <p class="new-users-table__name date">Дата добавления</p>
                                    <p class="new-users-table__name admin-control__buttons buttons module-users-buttons">
                                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.8639 10.6986L11.9375 16.625L9.91735 14.6049M13.5 1C6.59644 1 1 6.59644 1 13.5C1 20.4036 6.59644 26 13.5 26C20.4036 26 26 20.4036 26 13.5C26 6.59644 20.4036 1 13.5 1Z" stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-svg">
                                            <path d="M18.6265 9.78769C19.017 9.39717 19.017 8.764 18.6265 8.37348C18.236 7.98295 17.6028 7.98295 17.2123 8.37348L18.6265 9.78769ZM8.37348 17.2123C7.98295 17.6028 7.98295 18.236 8.37348 18.6265C8.764 19.017 9.39716 19.017 9.78769 18.6265L8.37348 17.2123ZM17.2123 18.6265C17.6028 19.017 18.236 19.017 18.6265 18.6265C19.017 18.236 19.017 17.6028 18.6265 17.2123L17.2123 18.6265ZM9.78769 8.37348C9.39716 7.98295 8.764 7.98295 8.37348 8.37348C7.98295 8.764 7.98295 9.39716 8.37348 9.78769L9.78769 8.37348ZM25 13.5C25 19.8513 19.8513 25 13.5 25V27C20.9558 27 27 20.9558 27 13.5H25ZM13.5 25C7.14873 25 2 19.8513 2 13.5H0C0 20.9558 6.04416 27 13.5 27V25ZM2 13.5C2 7.14873 7.14873 2 13.5 2V0C6.04416 0 0 6.04416 0 13.5H2ZM13.5 2C19.8513 2 25 7.14873 25 13.5H27C27 6.04416 20.9558 0 13.5 0V2ZM17.2123 8.37348L12.7929 12.7929L14.2071 14.2071L18.6265 9.78769L17.2123 8.37348ZM12.7929 12.7929L8.37348 17.2123L9.78769 18.6265L14.2071 14.2071L12.7929 12.7929ZM18.6265 17.2123L14.2071 12.7929L12.7929 14.2071L17.2123 18.6265L18.6265 17.2123ZM14.2071 12.7929L9.78769 8.37348L8.37348 9.78769L12.7929 14.2071L14.2071 12.7929Z" fill="#6C63FF"/>
                                        </svg>
                                    </p>
                                </div>
                                <div class="new-users-table__item">
                                    <p class="group-header-name">Группа: {{ $group_module->group->name }}</p>
                                </div>
                                <div class="new-users-table__item">
                                    <p class="new-users-table__name user-module__id">
                                        @php
                                            $user_modules = \App\Models\UserModule::where('student_id', '=', $group_module->user_id)
                                            ->where('module_id', '=', $group_module->id)->get();
                                            if($user_modules->count() > 0) {
                                                echo $user_modules[0]->id;
                                            } else {
                                                echo 'Нет';
                                            }
                                        @endphp
                                    </p>
                                    <p class="new-users-table__name user__id">
                                        {{ $group_module->user_id }}
                                    </p>
                                    <p class="new-users-table__name module__id">
                                        @if($group_module->count() !== 0)
                                            {{ $group_module->id }}
                                        @else
                                            Нет
                                        @endif
                                    </p>
                                    <p class="new-users-table__name surname">
                                        {{ $group_module->surname }}
                                    </p>
                                    <p class="new-users-table__name name">
                                        {{ $group_module->name }}
                                    </p>
                                    <p class="new-users-table__name patronymic">
                                        {{ $group_module->patronymic }}
                                    </p>
                                    <p class="new-users-table__name status">
                                        @if($group_module->count() > 0)
                                            @php
                                                $user_status = \App\Models\UserModule::query()
                                                ->where('student_id', '=', $group_module->user_id)
                                                ->where('module_id', '=', $group_module->id)->get();
                                                if(isset($user_status[0])) {
                                                   $status = \App\Models\UserModulesStatus::find($user_status[0]->status_id);
                                                    if(isset($status) and $status->count() > 0) :
                                                        echo '<label class="absolute">' . $status->name . '</label>';
                                                    endif;
                                                }
                                            @endphp
                                        @endif
                                        @if($statuses)
                                            <select wire:ignore wire:model="status_id.{{ $index }}" name="status_id" id="status_id">
                                                <option value="">Cтатус</option>
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            Без модуля
                                        @endif
                                    </p>
                                    <p class="new-users-table__name date">
                                        @if($group_module->count() !== 0)
                                            {{ $group_module->created_at }}
                                        @else
                                            Нет
                                        @endif
                                    </p>
                                    <p class="new-users-table__name date">
                                        @if($group_module->count() !== 0)
                                            {{ $group_module->updated_at }}
                                        @else
                                            Нет
                                        @endif
                                    </p>
                                    <p class="new-users-table__name admin-control__buttons buttons module-users-buttons">
                                        <a wire:click.prevent="accept({{ $group_module->user_id }} , {{ $index }})">
                                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.8639 10.6986L11.9375 16.625L9.91735 14.6049M13.5 1C6.59644 1 1 6.59644 1 13.5C1 20.4036 6.59644 26 13.5 26C20.4036 26 26 20.4036 26 13.5C26 6.59644 20.4036 1 13.5 1Z" stroke="#6C63FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        <a wire:click.prevent="reject({{ $group_module->user_id }})">
                                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-svg">
                                                <path d="M18.6265 9.78769C19.017 9.39717 19.017 8.764 18.6265 8.37348C18.236 7.98295 17.6028 7.98295 17.2123 8.37348L18.6265 9.78769ZM8.37348 17.2123C7.98295 17.6028 7.98295 18.236 8.37348 18.6265C8.764 19.017 9.39716 19.017 9.78769 18.6265L8.37348 17.2123ZM17.2123 18.6265C17.6028 19.017 18.236 19.017 18.6265 18.6265C19.017 18.236 19.017 17.6028 18.6265 17.2123L17.2123 18.6265ZM9.78769 8.37348C9.39716 7.98295 8.764 7.98295 8.37348 8.37348C7.98295 8.764 7.98295 9.39716 8.37348 9.78769L9.78769 8.37348ZM25 13.5C25 19.8513 19.8513 25 13.5 25V27C20.9558 27 27 20.9558 27 13.5H25ZM13.5 25C7.14873 25 2 19.8513 2 13.5H0C0 20.9558 6.04416 27 13.5 27V25ZM2 13.5C2 7.14873 7.14873 2 13.5 2V0C6.04416 0 0 6.04416 0 13.5H2ZM13.5 2C19.8513 2 25 7.14873 25 13.5H27C27 6.04416 20.9558 0 13.5 0V2ZM17.2123 8.37348L12.7929 12.7929L14.2071 14.2071L18.6265 9.78769L17.2123 8.37348ZM12.7929 12.7929L8.37348 17.2123L9.78769 18.6265L14.2071 14.2071L12.7929 12.7929ZM18.6265 17.2123L14.2071 12.7929L12.7929 14.2071L17.2123 18.6265L18.6265 17.2123ZM14.2071 12.7929L9.78769 8.37348L8.37348 9.78769L12.7929 14.2071L14.2071 12.7929Z" fill="#6C63FF"/>
                                            </svg>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </template>
        </div>
    </div>
</div>
