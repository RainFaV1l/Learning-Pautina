<form wire:submit.prevent="store" method="post" enctype="multipart/form-data">
    @csrf
    @isset($courses)
        <select wire:model="course_id" name="course_id" class="add-course-form__input add-course-form__select">
            <option value="" selected>Выберите курс</option>
            @foreach($courses as $course)
                <option wire:key="{{ $course->id }}" value="{{ $course['id'] }}">{{ $course['name'] }}</option>
            @endforeach
        </select>
        @error('course_id')
            <div class="input-column-error__text"> {{ $message }}</div>
        @enderror
    @endisset
    @isset($groups)
        <select wire:model="group_id" name="group_id" class="add-course-form__input add-course-form__select">
            <option value="" selected>Выберите группу</option>
            @foreach($groups as $group)
                <option wire:key="{{ $group->id }}" value="{{ $group['id'] }}">{{ $group['name'] }}</option>
            @endforeach
        </select>
        @error('group_id')
            <div class="input-column-error__text"> {{ $message }}</div>
        @enderror
    @endisset
    <div class="form__item">
        <div class="error__input-column">
            <div class="input-column @error('module_number') error @enderror">
                <input wire:model="module_number" type="text" name="module_number" class="input add-course-form__input"
                       required autofocus>
                <label for="profile-surname">Номер модуля</label>
            </div>
            @error('module_number')
                <div class="input-column-error__text"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="add-course-column-button">
        <button type="submit" class="button">Добавить</button>
    </div>
</form>
