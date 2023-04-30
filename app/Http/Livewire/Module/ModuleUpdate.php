<?php

namespace App\Http\Livewire\Module;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupModule;
use Livewire\Component;

class ModuleUpdate extends Component
{
    public $courses;
    public $groups;
    public $module;

    public $module_id;
    public $course_id;
    public $group_id;
    public $module_number;

    public $course_name;
    public $group_name;

    protected $listener = [
        'refreshModules' => 'getModules',
    ];

    protected $rules = [
        'course_id' => ['required', 'numeric'],
        'group_id' => ['required', 'numeric'],
        'module_number' => ['required', 'numeric'],
    ];

    public function getModules() {
        $this->module = GroupModule::find($this->module_id);
        $this->module_number = $this->module->module_number;
        $this->course_id = $this->module->course_id;
        $this->group_id = $this->module->group_id;
        $this->render();
    }

    public function changeCourseEvent($value) {
        $this->course_id = $value;
        $this->course_name = Course::find($this->course_id)->name;
    }

    public function changeGroupEvent($value) {
        $this->group_id = $value;
        $this->group_name = Course::find($this->group_id)->name;
    }

    public function render()
    {
        return view('livewire.admin.module.update');
    }

    public function mount() {
        $this->courses = Course::all();
        $this->groups = Group::all();
        $this->module = GroupModule::find($this->module_id);
        $this->module_number = $this->module->module_number;
        $this->course_id = $this->module->course_id;
        $this->group_id = $this->module->group_id;

        $this->course_name = $this->module->course->name;
        $this->group_name = $this->module->group->name;
    }

    public function update() {
        $validated = $this->validate($this->rules);
        GroupModule::query()->where('id', '=', $this->module_id)->update($validated);
        $this->emit('refreshModules');
    }
}
