<div class="container">
    <div class="lesson-names">
        <div class="one-lesson__info">
            <p class="one-lesson__name">
                {{ $course->name }}
            </p>
            <p class="one-lesson__subname">
                {{ $course->level->name }} курс
            </p>
        </div>
        <div class="lesson-progress-bar">
            <div class="lesson-progress-bar__item" style="width: {{ $percent }}%"></div>
        </div>
        <div class="one-lesson__lessons">
            @foreach ($module_lessons as $lesson)
                <div class="row">
                    <a
                        @if(\Illuminate\Support\Facades\Route::current()->lesson_id == $lesson->id
                        AND \Illuminate\Support\Facades\Route::current()->module_id == $lesson->module_id)
                        class="active" @endif href="{{ route('lessons.more', [$module_id, $lesson->id]) }}">
                        {{ $lesson['lesson_number'] . '. ' . $lesson['name'] }}
                    </a>
                    @isset($lesson->lesson_users_status_id)
                        @if($lesson->lesson_users_status_id === 3)
                            <div class="state completed"></div>
                        @elseif($lesson->lesson_users_status_id === 2)
                            <div class="state check"></div>
                        @endif
                    @endisset
                </div>
            @endforeach
        </div>
    </div>
    <div class="content">
        <div class="title-two">
            <div class="text">
                <h1>{{ $course->name }}</h1>
                <p>{{ $course->level->name }} курс</p>
            </div>
            <div class="line"></div>
        </div>
        <div class="video">
            <div class="video__container">
                @foreach ($videos as $video)
                    @isset($video->video->video_path)
                        <iframe width="100%" height="650" src="{{ $video->video->video_path }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    @endisset
                @endforeach
            </div>
            <div class="video__pagination">
                {{ $videos->links() }}
            </div>
        </div>
        <div class="one-course-banner">
            <div class="lesson-title">
                <h2>{{ $lesson->id . '. ' . $lesson->name }}</h2>
            </div>
            <div class="lesson-wrapper">
                <div class="lesson__item description">
                    <div class="subtitle">
                        <h3>Описание к уроку</h3>
                    </div>
                    <p>{{ $lesson->description }}</p>
                </div>
                <div class="lesson__item task">
                    <div class="subtitle">
                        <h3>Задание к уроку</h3>
                    </div>
                    <p>{{ $lesson->task }}</p>
                    @empty(!$lesson->lessonFiles->count())
                        <div class="images">
                            @foreach ($lesson->lessonFiles as $file)
                                <div class="image lesson-image">
                                    <div class="full-size">
                                        <div class="close__container">
                                            <div class="close">
                                                <svg width="15" height="15" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.28167 0.391474C1.7597 -0.130491 0.913435 -0.130491 0.391472 0.391474C-0.130491 0.913439 -0.130491 1.75971 0.391472 2.28168L8.10981 10L0.391552 17.7183C-0.13041 18.2403 -0.130411 19.0866 0.391552 19.6085C0.913514 20.1305 1.75978 20.1305 2.28175 19.6085L10 11.8902L17.7183 19.6085C18.2402 20.1305 19.0865 20.1305 19.6084 19.6085C20.1304 19.0866 20.1304 18.2403 19.6084 17.7183L11.8902 10L19.6085 2.28168C20.1305 1.75971 20.1305 0.913439 19.6085 0.391474C19.0866 -0.130491 18.2403 -0.130491 17.7183 0.391474L10 8.10984L2.28167 0.391474Z"
                                                        fill="#1D1D39" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="default" src="{{ $file->file_urls }}" alt="Скриншот или файл">
                                </div>
                            @endforeach
                        </div>
                    @endempty
                </div>
                @if($adminMessage->count() != 0)
                    <div class="lesson__item comment">
                        <div class="subtitle">
                            <h3>Комментарии от преподавателя</h3>
                            <div class="comment__comment">
                                @foreach($adminMessage as $message)
                                    <div class="comment__row">
                                        <p>{{ $message->created_at }}</p>
                                        <p>{{ $message->id }}) {{ $message->text }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="lesson__item comment">
                    @if(\App\Http\Livewire\Lesson\ShowMore::inProgress($lesson_id))
                        <form class="lesson-form">
                            <button wire:click.prevent="" class="button">Выполняется проверка</button>
                        </form>
                    @elseif(\App\Http\Livewire\Lesson\ShowMore::isCompleted($lesson_id))
                        <form class="lesson-form">
                            <button wire:click.prevent="" class="button completed">Выполнено</button>
                        </form>
                    @else
                        <div class="subtitle">
                            <h3>Ответ на задание</h3>
                            <p>Хотите загрузить ссылку на проект? Заполняйте данную форму.</p>
                        </div>
                        <form wire:submit.prevent="sendAnswer()" class="lesson-form">
                            <textarea wire:model="task" placeholder="Введите текст..."></textarea>
                            <button class="button">Отправить</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
