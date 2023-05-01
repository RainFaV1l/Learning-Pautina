<?php

namespace App\Http\Livewire\TeacherPanel;

use App\Models\Course;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CoursesShow extends Component
{
    public $courses;
    public function render()
    {
        return view('livewire.teacher-panel.courses-show');
    }

    public function mount() {
        if(Auth::user()->role_id === 3) :
            $this->courses = Course::all();
        elseif(Auth::user()->role_id === 2) :
            $this->courses = Group::query()
                ->join('group_modules', 'groups.id', '=', 'group_modules.group_id')
                ->join('courses', 'courses.id', '=', 'group_modules.course_id')
                ->where('groups.teacher_id', '=', Auth::user()->id)
                ->groupBy('groups.id')
                ->get();
        endif;
    }
}
