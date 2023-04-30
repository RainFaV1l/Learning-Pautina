<form wire:submit.prevent="store" method="post" enctype="multipart/form-data">
    @csrf
    @isset($lessons)
        <select wire:model="lesson_id" name="lesson_id" class="add-course-form__input add-course-form__select">
            <option value="" selected>Выберите урок</option>
            @foreach($lessons as $lesson)
                <option wire:key="{{ $lesson->id }}" value="{{ $lesson['id'] }}">{{ $lesson['name'] }}</option>
            @endforeach
        </select>
        @error('lesson_id')
            <div class="input-column-error__text"> {{ $message }}</div>
        @enderror
    @endisset
    <div class="add-course-column-button">
        <button type="submit" class="button">Добавить</button>
    </div>
</form>
