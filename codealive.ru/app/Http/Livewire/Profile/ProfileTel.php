<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileTel extends Component
{
    public $user;

    public $tel;
    public $password;

    protected $rules = [
        'tel' => ['required', 'string', 'min:17', 'max:17', 'unique:users'],
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
        $this->tel = $user->tel;
    }

    public function render()
    {
        return view('livewire.profile.profile-tel');
    }
}
