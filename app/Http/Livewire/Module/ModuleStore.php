<?php

namespace App\Http\Livewire\Module;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupModule;
use Livewire\Component;

class ModuleStore extends Component
{
    public $courses;
    public $groups;

    public $course_id;
    public $group_id;
    public $module_number;

    protected $rules = [
        'course_id' => ['required', ''],
        'group_id' => ['required', 'numeric'],
        'module_number' => ['required', 'numeric'],
    ];

    public function render()
    {
        $this->courses = Course::all();
        $this->groups = Group::all();
        return view('livewire.admin.module.store');
    }

    public function clearInputs()
    {
        $this->course_id = '';
        $this->group_id = '';
        $this->module_number = '';
    }

    public function store()
    {
        $validated = $this->validate($this->rules);
        GroupModule::create($validated);
        $this->clearInputs();
//        return redirect()->to('/dashboard/modules');
    }
}
