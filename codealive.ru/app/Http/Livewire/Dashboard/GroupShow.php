<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class GroupShow extends Component
{
    public Collection $groups;
    public $search;

    public function searchGroups() {
        $this->groups = Group::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function mount()
    {
        $this->groups = Group::all();
    }

    public function render()
    {
        $this->groups = Group::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.dashboard.group-show');
    }
}
