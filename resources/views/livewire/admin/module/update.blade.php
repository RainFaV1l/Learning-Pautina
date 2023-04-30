<form wire:submit.prevent="update" class="updatePreloaderForm" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Preloader -->
        <div wire:loading.flex wire:target="update" class="preloader_active" id="preloader">
            <div class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    @isset($courses)
        <div class="select-label">

            <label for="course_id">Выбрано: {{ $course_name }}</label>
            <select wire:click="changeCourseEvent($event.target.value)" id="course_id" wire:model="course_id" name="course_id" class="add-course-form__input add-course-form__select">
                <option value="">Выберите курс</option>
                @foreach($courses as $course)
                    <option
                        wire:key="{{ $course->id }}" value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                @endforeach
            </select>
            @error('course_id')
            <div class="input-column-error__text"> {{ $message }}</div>
            @enderror
        </div>
    @endisset
    @isset($groups)
        <div class="select-label">
            <label for="course_id">Выбрано: {{ $group_name }}</label>
            <select wire:click="changeGroupEvent($event.target.value)" wire:model="group_id" name="group_id" class="add-course-form__input add-course-form__select">
                <option value="">Выберите группу</option>
                @foreach($groups as $group)
                    <option
                        wire:key="{{ $group->id }}" value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                @endforeach
            </select>
            @error('group_id')
            <div class="input-column-error__text"> {{ $message }}</div>
            @enderror
        </div>
    @endisset
    <div class="form__item">
        <div class="error__input-column">
            <div class="input-column @error('module_number') error @enderror">
                <input wire:ignore value="{{ $module_number }}" wire:model="module_number" type="text" name="module_number" class="input add-course-form__input"
                       required autofocus>
                <label for="profile-surname">Номер модуля</label>
            </div>
            @error('module_number')
                <div class="input-column-error__text"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="add-course-column-button">
        <button type="submit" class="button">Сохранить</button>
    </div>
</form>
