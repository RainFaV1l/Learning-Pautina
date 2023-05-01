<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class NewUsers extends Component
{
    public Collection $users;

    public function render()
    {
        $this->users = User::query()->latest('created_at')->limit(10)->get();
        return view('livewire.admin.dashboard.new-users');
    }
}
