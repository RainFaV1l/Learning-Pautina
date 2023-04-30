<div class="content">
    <div class="title-two">
        <div class="text">
            <h1>Мои курсы</h1>
            <p>Список ваших курсов</p>
        </div>
        <div class="line"></div>
    </div>
    <div class="my-courses__nav">
        <div class="category-nav" x-data="{ active: 0 }">
            <a @click="active=0" :class="active === 0 ? 'active' : ''" wire:click.prevent="all">Все</a>
            <a @click="active=1" :class="active === 1 ? 'active' : ''" wire:click.prevent="active">Активные</a>
            <a @click="active=2" :class="active === 2 ? 'active' : ''" wire:click.prevent="completed">Завершенные</a>
        </div>
        <div class="courses">
            Всего курсов: {{ $applications->count() }}
        </div>
    </div>
    <div class="my-courses__wrapper">
        @foreach($applications as $application)
            <div class="courses__item">
                <div class="one">
                    <div class="name">
                        <p>{{ $application->course->level->name }} курс</p>
                        <h2>{{ $application->course->name }}</h2>
                    </div>
                    <div class="play">
                        @if(isset($progressBarResult))
                            @foreach($progressBarResult as $result)
                                @if(isset($result['course_id']))
                                    @if($result['course_id'] === $application->course_id)
                                        <div class="progressBar">
                                            <div class="line" style="height: {{ $result['result'] }}%"></div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        <div class="continue">
                            <a href="#" class="play-button">
                                <img src="{{ asset('assets/img/play.png') }}" alt="Изображение">
                            </a>
                            <div class="text">
                                <p>Вы остановились на уроке</p>
                                <div class="number-course">1. Введение в курс</div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $allLessonsCount = 0;
                    $user_modules = \App\Models\GroupModule::query()
                    ->join('lesson_modules', 'group_modules.id', '=', 'lesson_modules.module_id')
                    ->where('group_modules.course_id', '=', $application->course->id)
                    ->get();
                    $allLessonsCount = $user_modules->count()
                @endphp
                <div class="two">
                    <div class="lessons">
                        <div class="item">
                            <img src="{{ asset('assets/img/mini-play.svg') }}" alt="Изображение">
                            <p>{{ \App\Models\CourseUser::formatLessonsCount($allLessonsCount) }}</p>
                        </div>
{{--                        <div class="item">--}}
{{--                            <img src="{{ asset('assets/img/hat.png') }}" alt="Изображение">--}}
{{--                            <p>2 очных занятия</p>--}}
{{--                        </div>--}}
                    </div>
                    <a href="{{ route('courses.more', $application->course->id) }}" class="continue-training">
                        <p>Продолжить обучение</p>
                        <img src="{{ asset('assets/img/arrow2.png') }}" alt="Изображение">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
