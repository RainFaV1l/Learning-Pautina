<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupModule;
use Livewire\Component;

class ModuleShow extends Component
{
    public $modules;

    public $search;
    public $error = '';

    protected $listeners = ['getModule'];

    public function getModule() {
        $this->modules = GroupModule::query()
            ->select('group_modules.id', 'group_modules.course_id',
                'group_modules.group_id', 'group_modules.module_number', 'courses.name as courses_name', 'groups.name as groups_name', 'group_modules.created_at', 'group_modules.updated_at')
            ->leftJoin('courses', 'group_modules.course_id', '=', 'courses.id')
            ->leftJoin('groups', 'group_modules.group_id', '=', 'groups.id')
            ->where('course_id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('group_id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('module_number', 'LIKE', '%' . $this->search . '%')
            ->orWhere('courses.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('groups.name', 'LIKE', '%' . $this->search . '%')
            ->get();
    }

    public function searchModules()
    {
        $this->modules = GroupModule::query()
            ->select('group_modules.id', 'group_modules.course_id',
                'group_modules.group_id', 'group_modules.module_number', 'courses.name as courses_name', 'groups.name as groups_name', 'group_modules.created_at', 'group_modules.updated_at')
            ->leftJoin('courses', 'group_modules.course_id', '=', 'courses.id')
            ->leftJoin('groups', 'group_modules.group_id', '=', 'groups.id')
            ->where('course_id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('group_id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('module_number', 'LIKE', '%' . $this->search . '%')
            ->orWhere('courses.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('groups.name', 'LIKE', '%' . $this->search . '%')
            ->get();
    }

    public function destroy($id) {
        GroupModule::where('id', $id)->delete();
        $this->emit('getModule');
    }

    public function render()
    {
        $this->modules = GroupModule::query()
            ->select('group_modules.id', 'group_modules.course_id',
            'group_modules.group_id', 'group_modules.module_number', 'courses.name as courses_name', 'groups.name as groups_name', 'group_modules.created_at', 'group_modules.updated_at')
            ->leftJoin('courses', 'group_modules.course_id', '=', 'courses.id')
            ->leftJoin('groups', 'group_modules.group_id', '=', 'groups.id')
            ->where('course_id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('group_id', 'LIKE', '%' . $this->search . '%')
            ->orWhere('module_number', 'LIKE', '%' . $this->search . '%')
            ->orWhere('courses.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('groups.name', 'LIKE', '%' . $this->search . '%')
            ->get();
        return view('livewire.admin.dashboard.module-show');
    }
}
