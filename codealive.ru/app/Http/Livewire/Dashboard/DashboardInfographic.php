<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class DashboardInfographic extends Component
{
    public $userCount;
    public $courseCount;
    public $groupCount;

    public function render()
    {
        $this->userCount = User::all()->count();
        $this->courseCount = Course::all()->count();
        $this->groupCount = Group::all()->count();
        return view('livewire.admin.dashboard.dashboard-infographic');
    }
}
