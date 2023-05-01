<?php

namespace App\Http\Livewire\Course;

use App\Models\CourseUser;
use App\Models\GroupModule;
use App\Models\LessonModule;
use App\Models\LessonUser;
use App\Models\UserModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MyCoursesShow extends Component
{
    public $applications;
    public $progressBarResult;
    public $courses_id = [];

    public function mount()
    {
        $this->applications = CourseUser::where('user_id', '=', Auth::user()->id)->where('course_users_status_id', '=', 3)->get();
    }

    public function filter() {
        return $this->applications = CourseUser::where('user_id', '=', Auth::user()->id)->where('course_users_status_id', '=', 3)->get();
    }

    public function filterActiveOrCompleted() {
        foreach ($this->applications as $application) {

            $allModuleCount = 0;
            $learnedModuleCount = 0;

            $modules = GroupModule::query()
                ->where('group_modules.course_id', '=', $application->course_id)
                ->where('group_modules.group_id', '=', $application->group_id)
                ->get();

            $allModuleCount = $allModuleCount + $modules->count();

            $allLessonsCount = 0;
            $learnedLessonsCount = 0;

            foreach ($modules as $module) {
                $allLessons = LessonModule::query()->where('lesson_modules.module_id', '=', $module->id)->get();
                $learnedLessons = LessonUser::query()
                    ->select(
                        'lesson_users.lesson_id', 'lesson_users.user_id',
                        'lesson_modules.module_id', 'lesson_users.lesson_users_status_id',
                        'lesson_users.task',
                        'group_modules.course_id'
                    )
                    ->join('lesson_modules', 'lesson_users.lesson_id', '=', 'lesson_modules.lesson_id')
                    ->join('group_modules', 'lesson_modules.module_id', '=', 'group_modules.id')
                    ->where('lesson_modules.module_id', '=', $module->id)
                    ->where('lesson_users.lesson_users_status_id', '=', 3)
                    ->where('group_modules.course_id', '=', $module->course_id)
                    ->get();

                $allLessonsCount = $allLessonsCount + $allLessons->count();
                $learnedLessonsCount = $learnedLessonsCount + $learnedLessons->count();

                if($allLessonsCount === $learnedLessonsCount and $allLessonsCount !== 0 and $learnedLessonsCount !== 0) {
                    $learnedModuleCount = $learnedModuleCount + 1;
                }
            }

            if($learnedModuleCount === $allModuleCount and $learnedModuleCount !== 0 and $allModuleCount !== 0) {
                array_push($this->courses_id, $application->course_id);
            }
        }
        return $this->courses_id;
    }

    public function all()
    {
        $this->filter();
    }

    public function active()
    {
        $this->filter();
        $this->filterActiveOrCompleted();
        $this->applications = CourseUser::query()
            ->select(
                'course_users.course_id', 'course_users.user_id',
                'course_users.group_id', 'course_users.course_users_status_id',
            )
            ->where('user_id', '=', Auth::user()->id)
            ->where('course_users_status_id', '=', 3)
            ->whereNotIn('course_users.course_id',  $this->courses_id)
            ->get();
    }

    public function completed()
    {

        $this->filter();
        $this->filterActiveOrCompleted();

        $this->applications = CourseUser::query()
            ->select(
                'course_users.course_id', 'course_users.user_id',
                'course_users.group_id', 'course_users.course_users_status_id',
            )
            ->where('user_id', '=', Auth::user()->id)
            ->where('course_users_status_id', '=', 3)
            ->whereIn('course_users.course_id',  $this->courses_id)
            ->get();
    }

    public function progressBar() {
        $result = [];
        $tempResult = [];
        foreach ($this->applications as $application) {
            $this->group_modules = UserModule::query()
                ->leftJoin('group_modules', 'user_modules.module_id', '=', 'group_modules.id')
                ->where('user_modules.student_id', '=', Auth::user()->id)
                ->where('group_modules.course_id', '=', $application->course_id)
                ->get();

            $allModuleCount = $this->group_modules->count();
            $learnedModuleCount = 0;
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
                    $learnedModuleCount = $learnedModuleCount + 1;
                }

                $allModulesLessonCount = $allModulesLessonCount + $allLessonsCount;
                $allModulesLearnedLessonCount = $allModulesLearnedLessonCount + $learnedLessonsCount;

            }

            if(isset($allModulesLearnedLessonCount) and isset($allModulesLessonCount) and $allModulesLearnedLessonCount !== 0 and $allModulesLessonCount !==0) {
                $tempResult = [
                    'course_id' => $application->course_id,
                    'result' => $allModulesLearnedLessonCount / $allModulesLessonCount * 100,
                ];
            } else {
                $tempResult = [
                    'course_id' => $application->course_id,
                    'result' => 0,
                ];
            }

            $tempResult = array_unique($tempResult);

            array_push($result, $tempResult);

//            return [
//                'allModulesLessonCount' => $allModulesLessonCount,
//                'allModulesLearnedLessonCount' => $allModulesLearnedLessonCount,
//            ];
        }
        return $result;
    }

    public function render()
    {
        $this->progressBarResult = $this->progressBar();
        return view('livewire.course.my-courses-show');
    }
}
