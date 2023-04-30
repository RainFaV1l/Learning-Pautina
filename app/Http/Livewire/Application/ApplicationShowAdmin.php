<?php

namespace App\Http\Livewire\Application;

use App\Models\CourseUser;
use App\Models\Group;
use App\Models\GroupModule;
use App\Models\UserModule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ApplicationShowAdmin extends Component
{
    public Collection $applications;
    public Collection $groups;
    public $group_id;
    public $search;

    protected $rules = [
        'name' => ['required', 'string'],
        'price' => ['required', 'numeric', 'max:1000000'],
        'author' => ['required', 'numeric'],
        'course_category_id' => ['required', 'numeric'],
        'course_level_id' => ['required', 'numeric'],
        'description' => ['required', 'string'],
    ];

    protected $listeners = [
        'refreshComponent' => 'getApplications',
        'refreshGroups' => 'getGroups'
    ];

    public function getApplications() {
        $this->applications = CourseUser::whereHas('user', function (Builder $query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('surname', 'LIKE', '%' . $this->search . '%')
                ->orWhere('patronymic', 'LIKE', '%' . $this->search . '%');
        })->get();
    }

    public function getGroups() {
        $this->groups = Group::all();
    }

    public function searchApplications()
    {
        $this->applications = CourseUser::whereHas('user', function (Builder $query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('surname', 'LIKE', '%' . $this->search . '%')
                ->orWhere('patronymic', 'LIKE', '%' . $this->search . '%');
        })->get();
    }

    public function mount() {
        $this->applications = CourseUser::all();
        $this->groups = Group::all();
    }

    public function render()
    {
        $this->applications = CourseUser::whereHas('user', function (Builder $query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('surname', 'LIKE', '%' . $this->search . '%')
                ->orWhere('patronymic', 'LIKE', '%' . $this->search . '%');
        })->get();
        return view('livewire.application.applicationShowAdmin');
    }
    public function accept(CourseUser $application, $index) {
        if($this->group_id) {
            $this->group_id = $this->group_id[$index];
            $application->update(['course_users_status_id' => 3, 'group_id' => $this->group_id]);
            $group_modules = GroupModule::query()->select('user_modules.id')
                ->join('user_modules', 'group_modules.id', '=', 'user_modules.module_id')
                ->where('group_modules.group_id', '=', $this->group_id)
                ->where('user_modules.student_id', '=', $application->user_id)
                ->get();
            if(isset($group_modules)) {
                foreach ($group_modules as $group_module) {
                    UserModule::query()->where('id', '=', $group_module->id)->delete();
                }
            }
            $this->emit('refreshComponent');
            $this->emit('refreshGroups');
        }
    }

    public function reject(CourseUser $application) {
        $application->update([
            'course_users_status_id' => 1,
            'group_id' => null
        ]);
        $this->emit('refreshComponent');
        $this->emit('refreshGroups');
    }
}
