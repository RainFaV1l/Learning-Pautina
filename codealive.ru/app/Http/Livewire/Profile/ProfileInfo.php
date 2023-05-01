<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileInfo extends Component
{
    public $user;

    public $surname;
    public $name;
    public $patronymic;
    public $birthday_date;

    protected $rules = [
        'surname' => ['required', 'string',  'min:2', 'max:255'],
        'name' => ['required', 'string',  'min:2', 'max:255'],
        'patronymic' => ['required', 'string',  'min:2', 'max:255'],
        'birthday_date' => ['required', 'date', 'max:255'],
    ];

    public function update()
    {
        $validated = $this->validate($this->rules);
        User::query()->where('id', '=', Auth::user()->id)->update($validated);
        $this->render();
    }

    public function render()
    {
        return view('livewire.profile.profile-info', ['user']);
    }

    public function mount($user)
    {
        $this->surname = $user->surname;
        $this->name = $user->name;
        $this->patronymic = $user->patronymic;
        $this->birthday_date = $user->birthday_date;
    }
}
