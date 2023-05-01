<?php

namespace App\Http\Livewire\Lesson;

use App\Models\Course;
use App\Models\GroupModule;
use App\Models\Lesson;
use App\Models\LessonComment;
use App\Models\LessonModule;
use App\Models\LessonUser;
use App\Models\LessonVideosBundle;
use App\Models\UserModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMore extends Component
{
    use WithPagination;

    public $lesson_id;
    public $module_id;
    public $lesson;
    public $course;
    public $module_lessons;
    public $task;
    public $user_id;
    public $adminMessage;
    public $percent;

    protected $listeners = ['resetModules'];

    public $rules = [
        'lesson_id' => 'required',
        'user_id' => 'required',
        'task' => 'required',
    ];

    public function resetModules() {
        $this->module_lessons = Lesson::query()
            ->select('user_modules.module_id', 'lessons.id', 'lessons.lesson_number', 'lessons.task', 'lessons.description', 'lessons.name')
            ->join('lesson_modules', 'lessons.id', 'lesson_modules.lesson_id')
            ->join('user_modules', 'lesson_modules.module_id', 'user_modules.module_id')
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('user_modules.module_id', '=', $this->module_id)
            ->get();
    }

    public function progressBar() {

        $allModuleLessons = LessonModule::query()
            ->where('lesson_modules.module_id', '=', $this->module_id)->get();
        $allModuleLessonsCount = $allModuleLessons->count();
        $learnedLessons = LessonUser::query()
            ->join('lesson_modules', 'lesson_users.lesson_id', '=', 'lesson_modules.lesson_id')
            ->where('lesson_modules.module_id', '=', $this->module_id)
            ->where('lesson_users.user_id', '=', Auth::user()->id)
            ->where('lesson_users.lesson_users_status_id', '=', 3)
            ->get();
        $learnedLessonsCount = $learnedLessons->count();
        $this->percent = $learnedLessonsCount / $allModuleLessonsCount * 100;
    }

    public function render()
    {
        $this->progressBar();
        if($this->lesson_id and $this->module_id) {
            $this->adminMessage = LessonComment::query()
                ->where('lesson_id', '=', $this->lesson_id)
                ->where('student_id', '=', Auth::user()->id)->get();
        }
        return view('livewire.lesson.show-more', ['videos' => LessonVideosBundle::query()
            ->where('lesson_id', '=', $this->lesson_id)->paginate(1),
            'adminMessage' => $this->adminMessage]);
    }

    static function inProgress($lesson_id) {
        $check = LessonUser::query()
            ->where('lesson_id', '=', $lesson_id)
            ->where('user_id', '=', Auth::user()->id)
            ->where('lesson_users_status_id', '=', 2)
            ->get();
        return $check->count();
    }

    static function isCompleted($lesson_id) {
        $check = LessonUser::query()
            ->where('lesson_id', '=', $lesson_id)
            ->where('user_id', '=', Auth::user()->id)
            ->where('lesson_users_status_id', '=', 3)
            ->get();
        return $check->count();
    }

    public function sendAnswer() {
        $this->user_id = Auth::user()->id;
        $check = LessonUser::query()
            ->where('lesson_id', '=', $this->lesson_id)
            ->where('user_id', '=', $this->user_id)
            ->get();
        if($check->count() === 0) :
            $this->validate();
            LessonUser::query()->create([
                'lesson_id' => $this->lesson_id,
                'user_id' => Auth::user()->id,
                'task' => $this->task,
                'lesson_users_status_id' => 2
            ]);
        else:
            $check = LessonUser::query()
                ->where('lesson_id', '=', $this->lesson_id)
                ->where('user_id', '=', $this->user_id)
                ->where('lesson_users_status_id', '=', 1)
                ->get();
            if($check->count() !== 0) :
                $this->validate();
                LessonUser::query()->where('lesson_id', '=', $this->lesson_id)
                    ->where('user_id', '=', Auth::user()->id)
                    ->update([
                    'task' => $this->task,
                    'lesson_users_status_id' => 2
                ]);
            endif;
        endif;
        $this->emit('resetModules');
    }

    public function mount()
    {
        $this->lesson = Lesson::findOrFail($this->lesson_id);
        $this->course = Course::findOrFail($this->lesson->course_id);
        $this->module_lessons = Lesson::query()
            ->select('user_modules.module_id', 'lessons.id', 'lessons.lesson_number', 'lessons.task', 'lessons.description', 'lessons.name', 'lesson_users.lesson_users_status_id')
            ->join('lesson_modules', 'lessons.id', 'lesson_modules.lesson_id')
            ->leftJoin('lesson_users', 'lessons.id', 'lesson_users.lesson_id')
            ->join('user_modules', 'lesson_modules.module_id', 'user_modules.module_id')
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('user_modules.module_id', '=', $this->module_id)
            ->get();
    }
}
