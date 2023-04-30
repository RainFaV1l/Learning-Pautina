<div>
    <div class="profile__personal-password profile__personal-password-pass">
        <div class="title">
            Смена пароля
        </div>
        {{-- <form novalidate method="post" action="{{ route('profile.changePassword', $user) }}"> --}}
        <form wire:submit.prevent="update">
            <div class="form__item">
                <div class="error__input-column">
                    <div
                        class="input-column @error('current_password') error @enderror  @error('invalid_password') error @enderror">
                        <input wire:ignore wire:model="current_password" autocomplete="current-password" class="input"
                            id="current_password" type="password" required autofocus>
                        <label for="current_password">Текущий пароль</label>
                    </div>
                    @error('invalid_password')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                    @error('current_password')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="error__input-column">
                    <div class="input-column @error('password') error @enderror">
                        <input wire:ignore wire:model="password" autocomplete="new-password" class="input"
                            id="password" type="password" required autofocus>
                        <label for="password">Новый пароль</label>
                    </div>
                    @error('password')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form__item">
                <div class="error__input-column">
                    <div class="input-column @error('password_confirmation') error @enderror">
                        <input wire:ignore wire:model="password_confirmation" autocomplete="new-password" class="input"
                            id="password_confirmation" type="password" required autofocus>
                        <label for="password_confirmation">Подтверждение пароля</label>
                    </div>
                    @error('password_confirmation')
                        <div class="input-column-error__text"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form__item-button">
                <button class="button">Сохранить</button>
            </div>
        </form>
    </div>
</div>
