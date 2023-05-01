<section class="directions">
    <div class="container">
        <div class="directions-head">
            <div class="title">
                <h2>Направления</h2>
                <div class="line">
                </div>
            </div>
            <div class="directions-head_category" x-data="{currentButton: 0}">
                <button @click="currentButton = 0" :class="currentButton === 0 ? 'active' : ''" type="button" wire:click.prevent="$emit('refreshLevels')">Все</button>
                @foreach ($course_levels as $course_level)
                    <button @click="currentButton = {{ $course_level->id }}" :class="currentButton === {{ $course_level->id }} ? 'active' : ''" type="button" wire:click.prevent="setLevelId({{ $course_level->id }})">{{ $course_level['name'] }}</button>
                @endforeach
            </div>
        </div>
        <div class="directions-category" x-data="{currentButton: 0}">
            <div class="directions-category__main">
                <button @click="currentButton = 0" :class="currentButton === 0 ? 'active' : ''" wire:click.prevent="$emit('refreshCategories')">Все</button>
                @foreach ($categories as $category)
                    <button @click="currentButton = {{ $category->id }}" :class="currentButton === {{ $category->id }} ? 'active' : ''" wire:click.prevent="setCategoryId({{ $category->id }})">{{ $category['name'] }}</button>
                @endforeach
            </div>
            <div class="directions-category__all-course">
                Всего курсов: {{ $courses->count() }}
            </div>
        </div>
        <div class="directions-courses">
            @foreach ($courses as $course)
                <div class="best-course__item">
                    <div class="best-course__info">
                        <div class="best-course__text">
                            <div class="type">
                                {{ $course->level['name'] }}
                            </div>
                            <div class="name-cat">
                                <div class="name">
                                    {{ $course['name'] }}
                                </div>
                                <div class="cat">
                                    Данный курс входит в категорию “{{ $course->category['name'] }}”
                                </div>
                            </div>
                        </div>
                        <div class="best-course__img">
                            <img src="{{ $course->icon_url }}" alt="Изображение курса">
                        </div>
                    </div>
                    <div class="best-course__lessons">
                        <div class="best-course__time">
                            <div class="catalog-lesson">
                                12 уроков
                            </div>
                            {{--                            <div class="time">2 очных занятия</div> --}}
                        </div>
                        <a href="{{ route('catalog.show', $course['id']) }}" class="arrow">
                            Подробнее
                            <img src="{{ asset('assets/img/arrow2.png') }}" alt="Стрелка подробнее">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
