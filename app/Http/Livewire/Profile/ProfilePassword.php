<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfilePassword extends Component
{
    public $user;

    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'password' => ['required', 'string', 'min:6', 'same:password_confirmation'],
    ];

    public function clearInput()
    {
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function update()
    {
        $this->validate(['current_password' => ['required', 'string', 'min:6', '']]);
        $validated = $this->validate($this->rules);
        $validated['password'] = Hash::make($validated['password']);
        $this->validate(['password_confirmation' => ['required']]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('invalid_password', 'Неверный пароль.');
        }

        User::query()->where('id', '=', Auth::user()->id)->update($validated);
        $this->clearInput();
    }

    public function render()
    {
        return view('livewire.profile.profile-password');
    }
}
