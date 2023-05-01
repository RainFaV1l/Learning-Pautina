<?php

namespace App\Http\Livewire\Module;

use App\Models\Group;
use App\Models\GroupModule;
use App\Models\Lesson;
use App\Models\LessonModule;
use App\Models\UserModule;
use App\Models\UserModulesStatus;
use Livewire\Component;

class ModuleShow extends Component
{
    public $module_id;
    public $search;
    public $search_users;
    public $module_lessons;
    public $allUsers;
    public $group_modules;
    public $group_users;
    public $statuses;
    public $status_id;

    public $active = 'lessons';

    protected $listeners = ['getUsersComponent'];

    public function mount() {
        $this->module_lessons = LessonModule::query()
            ->select('lesson_modules.id', 'lesson_modules.module_id',
                'lessons.id as lesson_id', 'lessons.name', 'lessons.lesson_number', 'lesson_modules.created_at', 'lesson_modules.updated_at')
            ->leftJoin('lessons', 'lesson_modules.lesson_id', '=', 'lessons.id')
            ->where('lesson_modules.module_id', '=', $this->module_id)
            ->where(function ($query) {
                $query
                    ->where('lesson_modules.id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.module_id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.created_at', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.updated_at', 'LIKE', '%' . $this->search . '%')
//                    ->orwhere('lessons.name', 'LIKE', '%' . $this->search . '%')
//                    ->orWhere('lessons.lesson_number', 'LIKE', '%' . $this->search . '%')
                    ->get();
            })
            ->get();
    }

    public function getAllLessons() {
        $this->active = 'lessons';
        $this->module_lessons = LessonModule::query()
            ->select('lesson_modules.id', 'lesson_modules.module_id',
                'lessons.id as lesson_id', 'lessons.name', 'lessons.lesson_number', 'lesson_modules.created_at', 'lesson_modules.updated_at')
            ->leftJoin('lessons', 'lesson_modules.lesson_id', '=', 'lessons.id')
            ->where('lesson_modules.module_id', '=', $this->module_id)
            ->where('lessons.name', 'LIKE', '%' . $this->search . '%')
            ->get();
    }

    public function getAllUsers() {
        $this->active = 'users';
        $this->group_modules = GroupModule::query()
            ->select('group_modules.id', 'group_modules.course_id',
                'group_modules.group_id', 'group_modules.module_number',
                'group_modules.created_at', 'group_modules.updated_at',
                'groups.name as groups_name', 'users.id as user_id', 'users.surname',
                'users.name', 'users.patronymic')
            ->join('groups', 'group_modules.group_id', '=', 'groups.id')
            ->join('course_users', 'group_modules.group_id', '=', 'course_users.group_id')
            ->join('users', 'course_users.user_id', '=', 'users.id')
            ->where('group_modules.id', '=', $this->module_id)
            ->where('course_users.course_users_status_id', '=', 3)
            ->where('users.surname', 'LIKE', '%' . $this->search_users . '%')
            ->get();
    }

    public function accept($user_id, $index) {
        $check = UserModule::query()
            ->where('student_id', '=', $user_id)
            ->where('module_id', '=', $this->module_id)
            ->get()->count();
        if($check === 0) :
            UserModule::query()->create([
                'module_id' => $this->module_id,
                'student_id' => $user_id,
                'status_id' => $this->status_id[$index]
            ]);
        else :
            UserModule::query()
                ->where('student_id', '=', $user_id)
                ->where('module_id', '=', $this->module_id)
                ->update([
                'module_id' => $this->module_id,
                'student_id' => $user_id,
                'status_id' => $this->status_id[$index]
            ]);
        endif;
    }

    public function reject($user_id) {
        UserModule::query()->where('student_id', '=', $user_id)->delete();
    }

    public function getModuleLessons() {
        $this->module_lessons = LessonModule::query()
            ->select('lesson_modules.id', 'lesson_modules.module_id',
                'lessons.id as lesson_id', 'lessons.name', 'lessons.lesson_number', 'lesson_modules.created_at', 'lesson_modules.updated_at')
            ->leftJoin('lessons', 'lesson_modules.lesson_id', '=', 'lessons.id')
            ->where('lesson_modules.module_id', '=', $this->module_id)
            ->where(function ($query) {
                $query
                    ->where('lesson_modules.id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.module_id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.created_at', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.updated_at', 'LIKE', '%' . $this->search . '%')
//                    ->orwhere('lessons.name', 'LIKE', '%' . $this->search . '%')
//                    ->orWhere('lessons.lesson_number', 'LIKE', '%' . $this->search . '%')
                    ->get();
            })
            ->get();
    }

    public function searchModuleLessons()
    {
        $this->module_lessons = LessonModule::query()
            ->select('lesson_modules.id', 'lesson_modules.module_id',
                'lessons.id as lesson_id', 'lessons.name', 'lessons.lesson_number', 'lesson_modules.created_at', 'lesson_modules.updated_at')
            ->leftJoin('lessons', 'lesson_modules.lesson_id', '=', 'lessons.id')
            ->where('lesson_modules.module_id', '=', $this->module_id)
            ->where(function ($query) {
                $query
                    ->where('lesson_modules.id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.module_id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.created_at', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('lesson_modules.updated_at', 'LIKE', '%' . $this->search . '%')
//                    ->orwhere('lessons.name', 'LIKE', '%' . $this->search . '%')
//                    ->orWhere('lessons.lesson_number', 'LIKE', '%' . $this->search . '%')
                    ->get();
            })
            ->get();
    }

    public function destroy($module_lesson_id) {
        LessonModule::destroy($module_lesson_id);
    }

    public function render()
    {
        if($this->active == 'lessons') {
            $this->getAllLessons();
        }
        else if($this->active == 'users') {
            $this->statuses = UserModulesStatus::all();
            $this->getAllUsers();
        }
        return view('livewire.admin.module.show');
    }
}
