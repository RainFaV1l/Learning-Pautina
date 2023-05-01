<div class="content">
    <div class="title-two">
        <div class="text">
            <h1>Панель преподавателя</h1>
            <p>Список ваших курсов для проверки</p>
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
            Всего курсов: {{ $courses->count() }}
        </div>
    </div>
    <div class="teacher-panel__wrapper">
        @foreach($courses as $course)
            <div class="program-themes__item">
                <div class="program-themes__wrapper">
                    <div class="info">
                        <div class="circle "></div>
                        <div class="name">{{ $course->name }}</div>
                    </div>
                    <div class="program-theme__end">
                        <div class="status">
                            <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" width="35" height="35" rx="17.5" fill="#51C853" />
                                <path
                                    d="M16.5 22.4L12.5 18.4L13.9 17L16.5 19.6L23.1 13L24.5 14.4L16.5 22.4Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <a href="{{ route('teacher-panel.groups', $course->id) }}" class="play">
                            <svg width="36" height="35" viewBox="0 0 36 35" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="18" cy="17.5" r="17.5" fill="#6C63FF" class="play-fill" />
                                <path
                                    d="M24 18.366C24.6667 17.9811 24.6667 17.0189 24 16.634L15.75 11.8708C15.0833 11.4859 14.25 11.9671 14.25 12.7369V22.2631C14.25 23.0329 15.0833 23.5141 15.75 23.1292L24 18.366Z"
                                    fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
