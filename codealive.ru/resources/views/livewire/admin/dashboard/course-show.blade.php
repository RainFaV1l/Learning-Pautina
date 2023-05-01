<div class="admin-panel-info-new-users__container">
    <div class="admin-panel-info-new-users__header">
        <h3 class="admin-panel-info-new-users__title">Курсы</h3>
        <form wire:submit.prevent="searchCourses()" class="admin-panel-info-new-users__form">
            <input wire:model.debounce.250ms="search" type="search" placeholder="Поиск курсов по названию">
            <button type="submit">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="6.5" cy="6.5" r="5.75" stroke="#1D1D39" stroke-opacity="0.6"
                            stroke-width="1.5" />
                    <line x1="11.0607" y1="11" x2="16" y2="15.9393" stroke="#1D1D39"
                          stroke-opacity="0.6" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
        </form>
        <div class="admin-panel-info-new-users__buttons">
            <a href="{{ route('courses.add', null) }}" class="admin-panel-info-groups__button">Добавить курс</a>
        </div>
    </div>
    <div class="users-table courses-table">
        <div class="admin-panel-info-new-users__table new-users-table">
            <div class="new-users-table__item new-users-table__header">
                <p class="new-users-table__name id">id</p>
                <p class="new-users-table__name name">Название</p>
                <p class="new-users-table__name price">Цена</p>
                <p class="new-users-table__name author">Автор</p>
                <p class="new-users-table__name category">Категория</p>
                <p class="new-users-table__name category">Сложность</p>
                <p class="new-users-table__name date">Дата создания</p>
                <p class="new-users-table__name date">Дата изменения</p>
                <p class="new-users-table__name admin-control__buttons courses-buttons admin-control__hide">
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
            <div class="row__items" wire:poll.visible.3s>
                @if (isset($courses))
                    @foreach ($courses as $course)
                        <div class="new-users-table__item new-users-table__header">
                            <p class="new-users-table__name id">id</p>
                            <p class="new-users-table__name name">Название</p>
                            <p class="new-users-table__name price">Цена</p>
                            <p class="new-users-table__name author">Автор</p>
                            <p class="new-users-table__name category">Категория</p>
                            <p class="new-users-table__name category">Сложность</p>
                            <p class="new-users-table__name date">Дата создания</p>
                            <p class="new-users-table__name date">Дата изменения</p>
                            <p class="new-users-table__name admin-control__buttons courses-buttons admin-control__hide">
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
                        <div class="new-users-table__item">
                            <p class="new-users-table__name id">{{ $course['id'] }}</p>
                            <p class="new-users-table__name name">{{ $course['name'] }}</p>
                            <p class="new-users-table__name price">{{ $course['price'] }}</p>
                            <p class="new-users-table__name author">
                                {{ App\Models\User::getFioShort($course->user->surname, $course->user->name, $course->user->patronymic) }}
                            </p>
                            <p class="new-users-table__name category">
                                {{ $course->category['name'] }}
                            </p>
                            <p class="new-users-table__name category">
                                {{ $course->level['name'] }}
                            </p>
                            <p class="new-users-table__name date">{{ $course['created_at'] }}</p>
                            <p class="new-users-table__name date">{{ $course['updated_at'] }}</p>
                            <p class="new-users-table__name admin-control__buttons courses-buttons">
                                <a href="{{ route('courses.more', $course['id']) }}">
                                    <svg width="23" height="5" viewBox="0 0 23 5" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="2.5" cy="2.5" r="2.5" fill="#6C63FF" />
                                        <circle cx="11.5" cy="2.5" r="2.5" fill="#6C63FF" />
                                        <circle cx="20.5" cy="2.5" r="2.5" fill="#6C63FF" />
                                    </svg>
                                </a>
                                <a href="{{ route('courses.edit', $course['id']) }}">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.5098 3.49116H5.25977C3.1887 3.49116 1.50977 5.17009 1.50977 7.24116V19.7413C1.50977 21.8123 3.1887 23.4913 5.25977 23.4913H17.7598C19.8308 23.4913 21.5098 21.8123 21.5098 19.7413L21.5098 13.4912M7.75977 17.2412L12.3077 16.3248C12.5491 16.2761 12.7708 16.1573 12.9449 15.9831L23.1258 5.79655C23.6139 5.30817 23.6136 4.51651 23.1251 4.02853L20.9684 1.87428C20.48 1.38651 19.6888 1.38684 19.2009 1.87503L9.01889 12.0626C8.84513 12.2364 8.72648 12.4577 8.67779 12.6986L7.75977 17.2412Z"
                                            stroke="#6C63FF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <button wire:click.prevent="destroy( {{ $course['id'] }} )">
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
        </div>
    </div>
</div>
