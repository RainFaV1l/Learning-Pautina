<?php

namespace App\Http\Livewire\TeacherPanel;

use App\Models\Group;
use App\Models\LessonComment;
use App\Models\LessonUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupShow extends Component
{
    public $course_id;
    public $group_id;
    public $module_id;
    public $answers;
    public $group;
    public $comment = [];

    public $lesson_users_id;
    public $lesson_id;
    public $user_id;
    public $index;

    protected $listeners = [
        'updateComponent'
    ];

    protected $rules = [
        'comment' => 'required',
        'lesson_users_id' => 'required',
        'lesson_id' => 'required',
        'user_id' => 'required',
        'index' => 'required',
    ];

    public function updateComponent() {
        $this->group = Group::query()->find($this->group_id);
        $this->answers = LessonUser::query()
            ->select('lesson_users.id as lesson_users_id', 'lesson_users.lesson_id', 'lesson_users.lesson_users_status_id',
                'lesson_users.task as user_task', 'users.id as user_id', 'users.name', 'users.surname', 'users.patronymic',
                'lessons.name as lesson_name', 'lessons.lesson_number', 'lessons.task as lesson_task')
            ->join('users', 'lesson_users.user_id', 'users.id')
            ->join('lessons', 'lesson_users.lesson_id', 'lessons.id')
            ->join('group_modules', 'group_modules.course_id', 'lessons.course_id')
            ->where('lessons.course_id', '=', $this->course_id)
            ->where('group_modules.group_id', '=', $this->group_id)
            ->where('group_modules.id', '=', $this->module_id)
            ->where('lesson_users.lesson_users_status_id', '=', 2)->get();
    }

    public function render()
    {
        $this->group = Group::query()->find($this->group_id);
        $this->answers = LessonUser::query()
            ->select('lesson_users.id as lesson_users_id', 'lesson_users.lesson_id', 'lesson_users.lesson_users_status_id',
                'lesson_users.task as user_task', 'users.id as user_id', 'users.name', 'users.surname', 'users.patronymic',
                'lessons.name as lesson_name', 'lessons.lesson_number', 'lessons.task as lesson_task')
            ->join('users', 'lesson_users.user_id', 'users.id')
            ->join('lessons', 'lesson_users.lesson_id', 'lessons.id')
            ->join('group_modules', 'group_modules.course_id', 'lessons.course_id')
            ->where('lessons.course_id', '=', $this->course_id)
            ->where('group_modules.group_id', '=', $this->group_id)
            ->where('group_modules.id', '=', $this->module_id)
            ->where('lesson_users.lesson_users_status_id', '=', 2)->get();
        return view('livewire.teacher-panel.group-show');
    }

    public function accept($lesson_users_id) {
        LessonUser::query()->where('id', '=', $lesson_users_id)->update(['lesson_users_status_id' => 3]);
        $this->emit('updateComponent');
    }

    public function reject() {
        $this->validate($this->rules);
        LessonComment::query()->create([
            'lesson_id' => $this->lesson_id,
            'teacher_id' => Auth::user()->id,
            'student_id' => $this->user_id,
            'text' => $this->comment[number_format($this->index)]
        ]);
        LessonUser::query()->where('id', '=', $this->lesson_users_id)->update(['lesson_users_status_id' => 1]);
        $this->emit('updateComponent');
    }
}
