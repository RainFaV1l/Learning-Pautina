<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class NewGroups extends Component
{
    public Collection $users;
    public function render()
    {
        $this->groups = Group::query()->latest('created_at')->limit(10)->get();
        return view('livewire.admin.dashboard.new-groups');
    }
}
