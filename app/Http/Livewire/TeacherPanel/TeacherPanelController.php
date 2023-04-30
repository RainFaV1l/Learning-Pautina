<?php

namespace App\Http\Livewire\TeacherPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherPanelController extends Controller
{
    public function courses() {
        return view('livewire.teacher-panel.courses');
    }
    public function groups($course_id) {
        return view('livewire.teacher-panel.groups', compact('course_id'));
    }
    public function group($course_id, $group_id, $module_id) {
        return view('livewire.teacher-panel.group', compact('course_id','group_id', 'module_id'));
    }
}
