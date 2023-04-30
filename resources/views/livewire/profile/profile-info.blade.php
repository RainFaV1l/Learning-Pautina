<div>
    <div>
        <div class="profile__personal-information">
            {{-- <form action="{{ route('profile.changePersonalInfo', $user) }}" method="post"> --}}
            <form wire:submit.prevent="update">
                <div class="form__item">
                    <div class="error__input-column">
                        <div class="input-column @error('surname') error @enderror">
                            <input wire:ignore value="{{ $surname }}" wire:model="surname" class="input" id="profile-surname" type="text"
                                required autofocus>
                            <label for="profile-surname">Фамилия</label>
                        </div>
                        @error('surname')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__item">
                    <div class="error__input-column">
                        <div class="input-column @error('name') error @enderror">
                            <input wire:ignore value="{{ $name }}" wire:model="name" class="input" id="profile-name" type="text"
                                required autofocus>
                            <label for="profile-name">Имя</label>
                        </div>
                        @error('name')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__item">
                    <div class="error__input-column">
                        <div class="input-column @error('patronymic') error @enderror">
                            <input wire:ignore value="{{ $patronymic }}" wire:model="patronymic" class="input" id="profile-patronymic"
                                type="text" required autofocus>
                            <label for="profile-patronymic">Отчество</label>
                        </div>
                        @error('patronymic')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__item">
                    <div class="error__input-column">
                        <div class="input-column @error('birthday_date') error @enderror">
                            <input wire:ignore value="{{ $birthday_date }}" wire:model="birthday_date" class="input" id="profile-birthday"
                                type="date" min="1950-01-01" max="2030-01-01" required autofocus>
                            <label for="profile-birthday">Дата рождения</label>
                        </div>
                        @error('birthday_date')
                            <div class="input-column-error__text"> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__item-button">
                    <button type="submit" class="button">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
