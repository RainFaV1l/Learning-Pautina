<x-jet-action-section>
    <x-slot name="content">
        <x-slot name="title"></x-slot>
        <x-slot name="description"></x-slot>
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Завершите включение двухфакторной аутентификации.') }}
                @else
                    {{ __('Вы не включили двухфакторную аутентификацию.') }}
                @endif
            @else
                {{ __('Вы не включили двухфакторную аутентификацию.') }}
            @endif
        </h3>
        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Когда двухфакторная аутентификация включена, вам будет предложено ввести безопасный случайный токен во время аутентификации. Вы можете получить этот токен из приложения Google Authenticator вашего телефона.') }}
            </p>
        </div>
        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Чтобы завершить включение двухфакторной аутентификации, отсканируйте следующий QR-код с помощью приложения для проверки подлинности телефона или введите ключ настройки и предоставьте сгенерированный OTP-код.') }}
                        @else
                            {{ __('У вас включена двухфакторная аутентификация. Отсканируйте следующий QR-код с помощью приложения для проверки подлинности вашего телефона или введите ключ настройки.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-jet-label for="code" value="{{ __('Code') }}" />

                        <x-jet-input id="code" type="text" name="code" class="block mt-1 w-1/2"
                                     inputmode="numeric" autofocus autocomplete="one-time-code" wire:model.defer="code"
                                     wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-jet-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Сохраните эти коды восстановления в безопасном менеджере паролей. Их можно использовать для восстановления доступа к вашей учетной записи, если ваше устройство двухфакторной аутентификации потеряно.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif
        <div class="mt-5">
            @if (!$this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Включить') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Восстановить коды восстановления') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @elseif ($showingConfirmation)
                    <x-jet-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-jet-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Подтверждить') }}
                        </x-jet-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Показать коды восстановления') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-secondary-button wire:loading.attr="disabled">
                            {{ __('Отмена') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-danger-button wire:loading.attr="disabled">
                            {{ __('Отключить') }}
                        </x-jet-danger-button>
                    </x-jet-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-jet-action-section>
