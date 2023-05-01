<?php

namespace App\Http\Livewire\Course;

use App\Models\CourseUser;
use App\Models\GroupModule;
use App\Models\LessonModule;
use App\Models\LessonUser;
use App\Models\UserModule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OneCourseLearnShow extends Component
{
    public $disabled_modules;
    public $course_modules;
    public $show_disabled_modules;
    public $course;
    public $group_modules;
    public $completedModulesId = [];
    public $learnedModuleCount;

    public $course_id;
    public $open_module_id = [];

    public $result;
    public $percent = 0;


    public function setOpenModuleId() {
        foreach($this->course_modules as $course_modules) :
            $this->open_module_id[] = $course_modules->module_id;
        endforeach;
    }

    public function setDisabledModules() {
        $this->show_disabled_modules = GroupModule::query()
            ->where('course_id', '=', $this->course_id)
            ->whereNotIn('group_modules.id', $this->open_module_id)
            ->orderBy('module_number')
            ->get();
    }

    public function progressBar() {

        $this->group_modules = UserModule::query()
            ->leftJoin('group_modules', 'user_modules.module_id', '=', 'group_modules.id')
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('group_modules.course_id', '=', $this->course_id)
            ->get();

        $allModuleCount = $this->group_modules->count();
        $this->learnedModuleCount = 0;
        $allModulesLessonCount = 0;
        $allModulesLearnedLessonCount = 0;

        foreach ($this->group_modules as $group_module) {

            $allLessonsCount = 0;
            $learnedLessonsCount = 0;

            $allLessons = LessonModule::query()->where('lesson_modules.module_id', '=', $group_module->module_id)->get();
            $learnedLessons = LessonUser::query()
                ->select(
                    'lesson_users.lesson_id', 'lesson_users.user_id',
                    'lesson_modules.module_id', 'lesson_users.lesson_users_status_id',
                    'lesson_users.task',
                    'group_modules.course_id'
                )
                ->join('lesson_modules', 'lesson_users.lesson_id', '=', 'lesson_modules.lesson_id')
                ->join('group_modules', 'lesson_modules.module_id', '=', 'group_modules.id')
                ->where('lesson_modules.module_id', '=', $group_module->module_id)
                ->where('lesson_users.lesson_users_status_id', '=', 3)
                ->where('group_modules.course_id', '=', $group_module->course_id)
                ->get();

            $allLessonsCount = $allLessonsCount + $allLessons->count();
            $learnedLessonsCount = $learnedLessonsCount + $learnedLessons->count();

            if($allLessonsCount === $learnedLessonsCount and $allLessonsCount !== 0 and $learnedLessonsCount !== 0) {
                $this->learnedModuleCount = $this->learnedModuleCount + 1;
            }

            $allModulesLessonCount = $allModulesLessonCount + $allLessonsCount;
            $allModulesLearnedLessonCount = $allModulesLearnedLessonCount + $learnedLessonsCount;

        }

        return [
            'allModulesLessonCount' => $allModulesLessonCount,
            'allModulesLearnedLessonCount' => $allModulesLearnedLessonCount,
        ];

    }

    public function all() {
        $this->course_modules = CourseUser::query()
            ->join('group_modules', 'course_users.group_id', '=', 'group_modules.group_id')
            ->join('user_modules', 'group_modules.id', '=', 'user_modules.module_id')
            ->where('course_users.course_users_status_id', '=', 3)
            ->where('course_users.user_id', '=', Auth::user()->id)
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('course_users.course_id', '=', $this->course_id)
            ->orderBy('group_modules.module_number')->get();
    }

    public function completedModulesOperations() {
        $this->group_modules = UserModule::query()
            ->leftJoin('group_modules', 'user_modules.module_id', '=', 'group_modules.id')
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('group_modules.course_id', '=', $this->course_id)
            ->get();

        foreach ($this->group_modules as $group_module) {

            $allLessonsCount = 0;
            $learnedLessonsCount = 0;

            $allLessons = LessonModule::query()->where('lesson_modules.module_id', '=', $group_module->module_id)->get();
            $learnedLessons = LessonUser::query()
                ->select(
                    'lesson_users.lesson_id', 'lesson_users.user_id',
                    'lesson_modules.module_id', 'lesson_users.lesson_users_status_id',
                    'lesson_users.task',
                    'group_modules.course_id'
                )
                ->join('lesson_modules', 'lesson_users.lesson_id', '=', 'lesson_modules.lesson_id')
                ->join('group_modules', 'lesson_modules.module_id', '=', 'group_modules.id')
                ->where('lesson_modules.module_id', '=', $group_module->module_id)
                ->where('lesson_users.lesson_users_status_id', '=', 3)
                ->where('group_modules.course_id', '=', $group_module->course_id)
                ->get();

            $allLessonsCount = $allLessonsCount + $allLessons->count();
            $learnedLessonsCount = $learnedLessonsCount + $learnedLessons->count();

            if($allLessonsCount === $learnedLessonsCount and $allLessonsCount !== 0 and $learnedLessonsCount !== 0) {
                array_push($this->completedModulesId, $group_module->module_id);
            }

        }
    }

    public function active() {
        $this->completedModulesOperations();
        $this->course_modules = CourseUser::query()
            ->join('group_modules', 'course_users.group_id', '=', 'group_modules.group_id')
            ->join('user_modules', 'group_modules.id', '=', 'user_modules.module_id')
            ->where('course_users.course_users_status_id', '=', 3)
            ->where('course_users.user_id', '=', Auth::user()->id)
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('course_users.course_id', '=', $this->course_id)
            ->whereNotIn('group_modules.id', $this->completedModulesId)
            ->orderBy('group_modules.module_number')->get();
    }

    public function completed() {
        $this->completedModulesOperations();
        $this->course_modules = CourseUser::query()
            ->join('group_modules', 'course_users.group_id', '=', 'group_modules.group_id')
            ->join('user_modules', 'group_modules.id', '=', 'user_modules.module_id')
            ->where('course_users.course_users_status_id', '=', 3)
            ->where('course_users.user_id', '=', Auth::user()->id)
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('course_users.course_id', '=', $this->course_id)
            ->whereIn('group_modules.id', $this->completedModulesId)
            ->orderBy('group_modules.module_number')->get();
    }

    public function render()
    {
        $this->result = $this->progressBar();
        if(isset($this->result['allModulesLearnedLessonCount'])
            and isset($this->result['allModulesLessonCount'])
            and $this->result['allModulesLearnedLessonCount'] !== 0 and $this->result['allModulesLessonCount'] !== 0
        ) {
            $this->percent = $this->result['allModulesLearnedLessonCount'] / $this->result['allModulesLessonCount'] * 100;
        }
        if(isset($this->course_modules)) :
            $this->setOpenModuleId();
            $this->setDisabledModules();
        endif;

        return view('livewire.course.one-course-learn-show');
    }
}
