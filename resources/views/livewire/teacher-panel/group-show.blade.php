<div class="content">
    <div class="title-two">
        <div class="text">
            <h1 class="panel__title">Панель управления</h1>
            <p>Список заданий на проверку</p>
        </div>
        <div class="line"></div>
    </div>
    <div class="courses__nav">
        <div class="category-nav">
            <a href="{{ route('teacher-panel.groups', $course_id) }}" class="active close-course-button">Список групп</a>
        </div>
        <div class="courses">
            <p>Всего заданий на проверку: {{ $answers->count() }}</p>
        </div>
    </div>
    <div class="teacher-panel__group">
        <div class="group-user-table teacher-table">
            <h3 class="group-user-table__name">{{ $group->name }}</h3>
            <div class="group-user-table__table">
                <div class="group-user-table__tr-list group-user-table-tr-list group-user-header">
                    <p class="group-user-table-tr-list-item id">id</p>
                    <p class="group-user-table-tr-list-item fio">ФИО</p>
                    <p class="group-user-table-tr-list-item user__lesson">Урок</p>
                    <p class="group-user-table-tr-list-item answer">Задание</p>
                    <p class="group-user-table-tr-list-item icon">
                        <svg class="disabled" width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.25647 0.729895C1.8645 0.330868 1.22145 0.330928 0.829558 0.730027L0.687983 0.874205C0.305966 1.26325 0.306013 1.8866 0.688089 2.27559L8.56202 10.2919C8.94701 10.6838 9.57609 10.6918 9.97087 10.3097L18.2762 2.27193C18.6751 1.88587 18.6832 1.2488 18.2943 0.852706L18.1491 0.704867C17.7655 0.314196 17.139 0.304668 16.7437 0.68349L9.97074 7.17377C9.57547 7.55254 8.94911 7.54307 8.56548 7.15252L2.25647 0.729895Z" fill="#1D1D39"/>
                        </svg>
                    </p>
                </div>
                <div class="accordion__list">
                    @foreach($answers as $index => $answer)
                        <div wire:key="{{ $index }}" class="group-user-table__item group-user-table-item accordion__item">
                            <div class="group-user-table__tr-list group-user-table-tr-list">
                                <p class="group-user-table-tr-list-item id">{{ $answer->user_id }}</p>
                                <p class="group-user-table-tr-list-item fio">{{ $answer->surname . ' ' . $answer->name . ' ' . $answer->patronymic }}</p>
                                <p class="group-user-table-tr-list-item user__lesson">{{ $answer->lesson_number . '. ' . $answer->lesson_name }}</p>
                                <p class="group-user-table-tr-list-item answer">{{ $answer->user_task }}</p>
                                <div class="group-user-table-tr-list-item group-user-table-tr-list-item-button accordion__button icon">
                                    <svg width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.25647 0.729895C1.8645 0.330868 1.22145 0.330928 0.829558 0.730027L0.687983 0.874205C0.305966 1.26325 0.306013 1.8866 0.688089 2.27559L8.56202 10.2919C8.94701 10.6838 9.57609 10.6918 9.97087 10.3097L18.2762 2.27193C18.6751 1.88587 18.6832 1.2488 18.2943 0.852706L18.1491 0.704867C17.7655 0.314196 17.139 0.304668 16.7437 0.68349L9.97074 7.17377C9.57547 7.55254 8.94911 7.54307 8.56548 7.15252L2.25647 0.729895Z" fill="#1D1D39"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="group-user-table-item__accordion group-user-table-item-accordion accordion__content">
                                <div class="group-user-table-item-accordion__item">
                                    <p class="group-user-table-item-accordion__title">Задание</p>
                                    <p class="group-user-table-item-accordion__desk">{{ $answer->lesson_task }}</p>
                                </div>
                                <div class="group-user-table-item-accordion__item group-user-table-item-alternative">
                                    <div class="group-user__title">
                                        <p class="group-user-table-item-accordion__title">Комментарий пользователю</p>
                                        <p class="group-user-table-item-accordion__desk">Введите комментарий для пользователя</p>
                                    </div>
                                    <form wire:submit.prevent="reject()" class="group-user-table-item__form group-user-table-item-form">
                                        <input type="text" class="disabled" wire:model="lesson_users_id" x-data x-init="@this.set('lesson_users_id', '{{ $answer->lesson_users_id }}')">
                                        <input type="text" class="disabled" wire:model="lesson_id" x-data x-init="@this.set('lesson_id', '{{ $answer->lesson_id }}')">
                                        <input type="text" class="disabled" wire:model="user_id" x-data x-init="@this.set('user_id', '{{ $answer->user_id }}')">
                                        <input type="text" class="disabled" wire:model="index" x-data x-init="@this.set('index', '{{ $index }}')">
                                        <textarea wire:model="comment.{{ $index }}" name="comment" placeholder="Комментарий" class="group-user-table-item-form__textarea"></textarea>
                                        <div class="group-user-table-item-form__buttons">
                                            <a wire:click="accept({{ $answer->lesson_users_id }})" class="accept-button">Принять</a>
                                            <input type="submit" class="reject-button" value="Отклонить">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
