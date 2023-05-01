<div>
    <div class="profile__personal-password profile__personal-email profile__personal-tel">
        <div class="title">
            Смена телефона
        </div>
        {{-- <form method="post" action="{{ route('profile.changeTel', $user) }}" wire:submit.prevent="updateTel"> --}}
        <form wire:submit.prevent="update">
            <div class="form__item">
                <div class="error__input-column">
                    <div class="input-column @error('tel') error @enderror @error('invalid_tel') error @enderror">
                        <input wire:ignore wire:model="tel" id="profile-tel" type="text" class="input tel"
                            value="{{ $user['tel'] }}" required autofocus autocomplete="tel">
                        <label for="profile-tel">Телефон</label>
                    </div>
                    @error('invalid_tel')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                    @error('tel')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="error__input-column">
                    <div class="input-column @error('password') error @enderror">
                        <input wire:ignore wire:model="password" class="input" id="profile-password_tel"
                            type="password" required autofocus>
                        <label for="profile-password_tel">Пароль</label>
                    </div>
                    @error('invalid_password')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                    @error('password')
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
