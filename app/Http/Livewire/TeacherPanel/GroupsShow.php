<?php

namespace App\Http\Livewire\TeacherPanel;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\GroupModule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupsShow extends Component
{
    public $course_id;
    public $course;
    public $groups;
    public $groups_users;

    public function render()
    {
        return view('livewire.teacher-panel.groups-show');
    }

    public function mount() {
        if(Auth::user()->role_id === 3 or Auth::user()->role_id === 2) :
            $this->course = Course::query()->findOrFail($this->course_id);
            $this->groups = GroupModule::query()
                ->select('group_modules.id as module_id',
                    'group_modules.module_number', 'groups.name',
                    'groups.id as group_id')
                ->join('groups', 'group_modules.group_id', 'groups.id')
                ->where('course_id', '=', $this->course_id)
                ->get();
        endif;
    }
}
