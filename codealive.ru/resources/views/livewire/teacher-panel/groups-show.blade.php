<div class="content">
    <div class="title-two">
        <div class="text">
            <h1>Панель управления</h1>
            <p>Список ваших групп курса {{ $course->name }}</p>
        </div>
        <div class="line"></div>
    </div>
    <div class="courses__nav">
        <div class="category-nav">
            <a href="" class="active">Все</a>
            <a href="">Активные</a>
            <a href="">Завершенные</a>
        </div>
        <div class="courses">
            <p>Всего групп: {{ $groups->count() }}</p>
{{--            <a href="" class="button">Мои курсы</a>--}}
        </div>
    </div>
    <div class="teacher-panel__wrapper">
        @foreach($groups as $group)
            <div class="program-themes__item ">
                <div class="program-themes__wrapper">
                    <div class="info">
                        <div class="circle"></div>
{{--                        (завершена)--}}
                        <div class="name">{{ $group->name . ' (Модуль ' . $group->module_number . ')' }}</div>
                    </div>
                    <div class="program-theme__end">
                        @php
                            // Код проверки на статус модуля
                            $allCourseModuleLessons = \App\Models\LessonModule::query()
                            ->where('lesson_modules.module_id', '=', $group->module_id);
                            $allCourseModuleLessonsCount = $allCourseModuleLessons->count();
                            $checkAllModuleUsers = \App\Models\UserModule::query()
                            ->where('user_modules.module_id', '=', $group->module_id)
                            ->get();
                            $checkAllModuleUsersCount = $checkAllModuleUsers->count();
                            $counter = 0;
                            foreach ($checkAllModuleUsers as $user) :
                                $checkFinishLessons = \App\Models\LessonModule::query()
                                ->join('lesson_users', 'lesson_modules.lesson_id', 'lesson_users.lesson_id')
                                ->where('lesson_modules.module_id', '=', $group->module_id)
                                ->where('lesson_users.user_id', '=', $user->student_id)
                                ->where('lesson_users.lesson_users_status_id', '=', 3)
                                ->get();
                                $checkFinishLessonsCount = $checkFinishLessons->count();
                                if($checkFinishLessonsCount === $allCourseModuleLessonsCount) {
                                    $counter++;
                                }
                            endforeach;
                        @endphp
                        @if($checkAllModuleUsersCount === $counter)
                            <div class="status">
                                <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.5" width="35" height="35" rx="17.5" fill="#51C853" />
                                    <path
                                        d="M16.5 22.4L12.5 18.4L13.9 17L16.5 19.6L23.1 13L24.5 14.4L16.5 22.4Z"
                                        fill="white" />
                                </svg>
                            </div>
                        @endif
                        <a href="{{ route('teacher-panel.group', [$course_id, $group->group_id, $group->module_number]) }}" class="play">
                            <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="18" cy="17.5" r="17.5" fill="#6C63FF" class="play-fill" />
                                <path
                                    d="M24 18.366C24.6667 17.9811 24.6667 17.0189 24 16.634L15.75 11.8708C15.0833 11.4859 14.25 11.9671 14.25 12.7369V22.2631C14.25 23.0329 15.0833 23.5141 15.75 23.1292L24 18.366Z"
                                    fill="white" />
                            </svg>
                        </a>
                        <div class="arrow">
                            <svg width="20" height="12" viewBox="0 0 20 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.38557 1.22386C2.89539 0.723678 2.08997 0.723751 1.59988 1.22402L1.50696 1.31887C1.03081 1.80492 1.03087 2.58253 1.5071 3.0685L9.08105 10.7975C9.56251 11.2888 10.3505 11.2988 10.8442 10.8199L18.8338 3.06946C19.331 2.58711 19.3411 1.79237 18.8563 1.2975L18.7597 1.1989C18.28 0.709176 17.4953 0.69724 17.0009 1.17214L10.4968 7.41943C10.2002 7.70434 9.72948 7.69722 9.44162 7.40348L3.38557 1.22386Z"
                                    fill="#6C63FF" class="arcol" />
                            </svg>
                        </div>
                    </div>
                </div>
                @php
                    $groups_users = \App\Models\CourseUser::query()
                    ->select('users.id', 'users.name', 'users.surname', 'users.patronymic')
                    ->join('users', 'course_users.user_id', 'users.id')
                    ->join('user_modules', 'course_users.user_id', 'user_modules.student_id')
                    ->where('course_users.course_id', '=', $course_id)
                    ->whereNotNull('course_users.group_id')
                    ->where('course_users.group_id', '=', $group->group_id)
                    ->where('user_modules.module_id', '=', $group->module_id)
                    ->get();
                    //dd($groups_users);
                @endphp
                <div class="about student-list">
                    <div class="student-list__wrapper">
                        <div class="student-list__head">
                            <div class="id">id</div>
                            <div class="fio">ФИО</div>
                            <div class="progress">Прогресс</div>
                        </div>
                        @foreach($groups_users as $groups_user)
                            <div class="student-list__item">
                                <div class="id">{{ $groups_user->id }}</div>
                                <div class="fio">{{ $groups_user->surname . ' ' . $groups_user->name . ' ' . $groups_user->patronymic }}</div>
                                @php
                                    $user_lessons = \App\Models\LessonModule::query()
                                    ->select('lessons.lesson_number', 'lessons.id')
                                    ->join('lessons', 'lesson_modules.lesson_id', 'lessons.id')
                                    ->where('lesson_modules.module_id', '=', $group->module_id)
                                    ->orderBy('lessons.lesson_number')
                                    ->get();
                                @endphp
                                <div class="progress__items progress">
                                    <div class="progress__line"></div>
                                    @foreach($user_lessons as $lesson)
                                        @php
                                            $checkActive = \App\Models\LessonUser::query()
                                                        ->select('lesson_users.lesson_users_status_id')
                                                        ->join('lesson_modules', 'lesson_users.lesson_id', 'lesson_modules.lesson_id')
                                                        ->where('lesson_modules.module_id', '=', $group->module_id)
                                                        ->where('lesson_users.user_id', '=', $groups_user->id)
                                                        ->where('lesson_users.lesson_id', '=', $lesson->id)
                                                        ->get();
                                        @endphp
                                        <div class="progress__item
                                            @if($checkActive->count() != 0)
                                                @if($checkActive[0]->lesson_users_status_id == 3)
                                                    active
                                                @endif
                                            @endif
                                        ">
                                            {{ $lesson->lesson_number }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
