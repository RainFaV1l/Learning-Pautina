<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileEmail extends Component
{
    public $user;

    public $email;
    public $password;

    protected $rules = [
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    ];

    public function clearInput()
    {
        $this->password = '';
    }

    public function update()
    {
        $validated = $this->validate($this->rules);
        $this->validate(['password' => ['required']]);

        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->addError('invalid_password', 'Неверный пароль.');
        } else {
            User::query()->where('id', '=', Auth::user()->id)->update($validated);
            $this->clearInput();
        }
    }

    public function mount($user)
    {
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.profile.profile-email', ['user']);
    }
}
