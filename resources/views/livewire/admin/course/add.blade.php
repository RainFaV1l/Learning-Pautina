@extends('layouts.app-dashboard')

@section('page-title')
    Добавление курса
@endsection

@section('content')
    <section class="admin-panel">
        <div class="admin-panel__container">
            <div class="admin-panel-content">
                @include('components.admin-aside')
                <div class="admin-panel-content__content">
                    <div class="admin-panel-content-aside__header admin-panel-content-aside-header">
                        <div class="admin-panel-content-aside-header__container">
                            <h1 class="admin-panel-content-aside-header__title">Добавление курса</h1>
                            <p class="admin-panel-content-aside-header__subtitle">Страница добавления курса</p>
                            <div class="admin-panel-line"></div>
                        </div>
                    </div>
                    <div class="admin-panel-info__tables">
                        <div class="admin-panel-info__new-users admin-panel-info-new-users admin-panel-info-users">
                            <div class="admin-panel-info-new-users__container admin-crud">
                                <div class="add-course__form add-course-form">
                                    <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('name') error @enderror">
                                                    <input wire:ignore value="{{ old('name') }}" wire:model="name" type="text" name="name" class="input"
                                                           required autofocus>
                                                    <label for="profile-surname">Название</label>
                                                </div>
                                                @error('name')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('price') error @enderror">
                                                    <input wire:ignore value="{{ old('price') }}" wire:model="price" type="text" name="price" class="input"
                                                           required autofocus>
                                                    <label for="profile-surname">Цена</label>
                                                </div>
                                                @error('price')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('author') error @enderror">
                                                    <select wire:ignore wire:model="author" name="author" class="add-course-form__input add-course-form__select" required autofocus>
                                                        <option value="0" selected disabled>Автор</option>
                                                        @foreach ($users as $user)
                                                            <option @if($user['id'] == old('author')) selected @endif value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('author')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('course_category_id') error @enderror">
                                                    <select wire:ignore wire:model="course_category_id" name="course_category_id"
                                                            class="add-course-form__input add-course-form__select" required autofocus>
                                                        <option value="0" selected disabled>Категория</option>
                                                        @foreach ($categories as $category)
                                                            <option @if($category['id'] == old('course_category_id')) selected @endif value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('course_category_id')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('course_level_id') error @enderror">
                                                    <select wire:ignore wire:model="course_level_id" name="course_level_id"
                                                            class="add-course-form__input add-course-form__select" required autofocus>
                                                        <option value="0" selected disabled>Сложность</option>
                                                        @foreach ($levels as $level)
                                                            <option @if($level['id'] == old('course_level_id')) selected @endif value="{{ $level['id'] }}">{{ $level['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('course_level_id')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form__item">
                                            <div class="error__input-column">
                                                <div class="input-column @error('description') error @enderror">
                                    <textarea wire:model="description" name="description" placeholder="Введите описание..."
                                              class="add-course-form__input add-course-form__textarea" required autofocus>{{ old('description') }}</textarea>
                                                </div>
                                                @error('description')
                                                <div class="input-column-error__text"> {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="add-course-form__img add-course-form-img dragable-img">
                                            <input wire:model="course_icon_path" id="dragImg" type="file" name="course_icon_path"
                                                   multiple class="hidden add-course-form-img__img drag-img" draggable="true">
                                            <label for="dragImg" class="add-course-form-img-content add-course-form-img-content__button">
                                                <div class="add-course-form-img-content__name">
                                                    <div class="add-course-form-img-content__svg">
                                                        <svg width="60" height="50" viewBox="0 0 60 50" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M27.9099 0.120327C24.5894 0.53091 21.4449 1.70045 18.7815 3.54186C14.8626 6.2542 11.9293 10.2605 10.4392 14.9884C9.98164 16.4566 9.48885 18.8952 9.48885 19.7164C9.48885 20.214 9.35979 20.326 8.56193 20.5002C6.33264 20.9979 3.76308 22.802 2.27297 24.9046C0.700732 27.1069 -0.144054 30.0805 0.02021 32.7928C0.348738 38.0309 3.64575 42.2611 8.52673 43.6795C9.37152 43.9283 9.75871 43.9532 15.0386 43.9906L20.6353 44.0403V42.0496V40.0589L15.2733 40.0216L9.89951 39.9843L8.97259 39.6359C7.50595 39.0884 6.44997 38.317 5.48785 37.0977C4.92466 36.3885 4.17374 34.7711 3.97428 33.8504C3.78655 32.9919 3.78655 31.1629 3.97428 30.3169C4.71346 27.0073 7.40035 24.5065 10.5683 24.183C11.8472 24.0586 12.0584 23.9964 12.4221 23.6604C12.9971 23.1503 13.1144 22.7771 13.2317 21.0352C13.4312 18.2607 13.9474 16.2699 15.0386 14.0055C17.2797 9.31491 21.3158 5.93071 26.0912 4.73628C33.0607 2.98197 40.2179 5.96803 44.1251 12.2388C45.2749 14.0802 45.9437 15.7101 46.5656 18.2109C46.9293 19.6666 47.2578 20.015 48.6306 20.3136C50.5666 20.749 51.998 21.5453 53.406 22.9886C58.8854 28.5999 56.0577 38.429 48.5602 39.8723C47.9266 39.9843 46.5069 40.034 43.5501 40.0465H39.4083V42.0496V44.0528L44.0781 43.9906C47.9618 43.9532 48.8887 43.9035 49.6162 43.7293C53.5116 42.7712 56.7617 40.1584 58.5099 36.5627C59.6128 34.3107 60 32.6062 60 30.0307C59.9883 29.0727 59.9296 27.9529 59.8357 27.5423C59.2608 24.6309 58.064 22.2545 56.1867 20.2638C54.6849 18.6712 52.9836 17.5639 50.9538 16.8547L50.0034 16.5188L49.8039 15.7349C49.6866 15.2995 49.3815 14.3663 49.1116 13.6571C46.8354 7.66013 42.107 3.0193 36.2404 1.04103C33.577 0.132771 30.5498 -0.203163 27.9099 0.120327Z"
                                                                fill="#6C63FF" />
                                                            <path
                                                                d="M29.3185 24.3199C29.0604 24.4318 27.4295 26.0742 25.0711 28.575L21.2227 32.6435L22.5368 34.037L23.8626 35.4429L25.998 33.1785L28.1452 30.9016V40.457V50H30.0225H31.8998V40.457V30.9016L34.0704 33.2034L36.2411 35.5052L37.5552 34.0992L38.881 32.7057L35.0091 28.5874C32.8737 26.3106 30.9729 24.3945 30.7617 24.295C30.2806 24.071 29.8348 24.0835 29.3185 24.3199Z"
                                                                fill="#6C63FF" />
                                                        </svg>
                                                    </div>
                                                    <p class="add-course-form-img-content-name__text">Перетащите сюда изображение курса</p>
                                                </div>
                                            </label>
                                            @error('course_icon_path')
                                            <div class="input-column-error__text"> {{ $message }}</div>
                                            @enderror
                                        </div>
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
