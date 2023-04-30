<div>
    <div class="title-two">
        <div class="text">
            <h1>Мои заявки</h1>
            <p>Список ваших заявок</p>
        </div>
        <div class="line"></div>
    </div>
    <div class="my-courses__nav">
        <div class="category-nav" x-data="{
            active: 0
        }">
            <a @click="active=0" :class="active === 0 ? 'active' : ''"  wire:click.prevent="all()">Все</a>
            <a @click="active=1" :class="active === 1 ? 'active' : ''" wire:click.prevent="inProcessing()">В обработке</a >
            <a @click="active=2" :class="active === 2 ? 'active' : ''" wire:click.prevent="accepted()">Принятые</a>
        </div>
        <div class="courses">
            Всего курсов: {{ count($applications) }}
        </div>
    </div>
    <div class="my-courses__wrapper">
        @foreach ($applications as $application)
            <div class="courses__item">
                <div class="one">
                    <div class="name">
                        <p>{{ $application->course->level->name }} курс</p>
                        <h2>{{ $application->course->name }}</h2>
                        <p class="text">{{ $application->course->description }}</p>
                    </div>
                </div>
                <div class="two">
                    <div class="lessons">
                        <div class="item">
                            <img src="{{ asset('assets/img/hat.png') }}" alt="icon">
                            @php
                                // Получаем общее количество уроков курса
                                $lessons = \App\Models\LessonModule::query()
                                ->join('lessons', 'lesson_modules.lesson_id', '=', 'lessons.id')
                                ->join('group_modules', 'group_modules.id', '=', 'lesson_modules.module_id')
                                ->where('group_modules.course_id', '=', $application->course_id)
                                ->get();
                                $lessonsCount = $lessons->count();
                            @endphp
                            <p>{{ \App\Models\CourseUser::formatLessonsCount($lessonsCount) }}</p>
                        </div>
                    </div>
                    <div class="continue-training">
                        @if (\Illuminate\Support\Facades\Auth::user()->role_id === 1)
                            @if ($application->course_users_status_id == 2)
                                <form wire:submit.prevent="unsubscribe({{ $application }})" method="POST">
                                    @csrf
                                    <button type="submit" class="courses-button">Отменить</button>
                                </form>
                                <button type="button" class="courses-button processing">В обработке</button>
                            @elseif($application->course_users_status_id == 1)
                                <button type="button" class="courses-button rejected">Отклонено</button>
                            @elseif($application->course_users_status_id == 3)
                                <button type="button" class="courses-button accepted">Принято</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
