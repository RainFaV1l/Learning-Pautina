<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use App\Models\CourseUser;
use App\Models\GroupModule;
use App\Models\LessonModule;
use App\Models\LessonUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    public function index() {
        return view('livewire.course.my-courses');
    }

    public function add()
    {
        $users = User::all();
        $categories = CourseCategory::all();
        $levels = CourseLevel::all();
        return view('livewire.admin.course.add', compact('categories', 'users', 'levels'));
    }

    public function more($course_id)
    {
        $course = Course::findOrFail($course_id);
        $course_modules = CourseUser::query()
            ->join('group_modules', 'course_users.group_id', '=', 'group_modules.group_id')
            ->join('user_modules', 'group_modules.id', '=', 'user_modules.module_id')
            ->where('course_users.course_users_status_id', '=', 3)
            ->where('course_users.user_id', '=', Auth::user()->id)
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->where('course_users.course_id', '=', $course_id)
            ->orderBy('group_modules.module_number')->get();
        if($course_modules->count() == 0) {
            $disabled_modules = GroupModule::query()
                ->where('course_id', '=', $course_id)
                ->orderBy('module_number')->get();
            return view('livewire.course.one-course-learn', compact('course', 'course_modules', 'disabled_modules', 'course_id'));
        } else {

            $allLessonsCount = 0;
            $learnedLessonsCount = 0;
            $learnedModuleCount = 0;

            foreach ($course_modules as $course_module) {

                $lessons = LessonModule::query()->where('module_id', '=', $course_module->module_id)->get();
                $learnedLessons = LessonUser::query()
                    ->where('lesson_users.user_id', '=', Auth::user()->id)
                    ->where('lesson_users.lesson_users_status_id', '=', 3)
                    ->get();

                $learnedLessonsCount = $learnedLessonsCount + $learnedLessons->count();
                $allLessonsCount = $allLessonsCount + $lessons->count();

                $moduleLessons = LessonModule::query()->where('lesson_modules.module_id', '=', $course_module->module_id)->get();
                $moduleLearnedLessons = LessonModule::query()
                    ->join('lesson_users', 'lesson_modules.lesson_id', '=', 'lesson_users.lesson_id')
                    ->where('lesson_modules.module_id', '=', $course_module->module_id)
                    ->where('lesson_users.lesson_users_status_id', '=', 3)->get();

                $moduleLearnedLessonsCount = $moduleLearnedLessons->count();
                $moduleLessonsCount = $moduleLessons->count();

                if($moduleLessonsCount === $moduleLearnedLessonsCount) {
                    $learnedModuleCount = $learnedModuleCount + 1;
                }
            }

            return view('livewire.course.one-course-learn', compact('course', 'course_modules', 'course_id', 'allLessonsCount', 'learnedLessonsCount', 'learnedModuleCount'));
        }
    }

    public function edit($id)
    {
        $course_id = $id;
        $users = User::all();
        $categories = CourseCategory::all();
        $levels = CourseLevel::all();
        return view('livewire.admin.course.edit', compact('categories', 'users', 'levels', 'course_id'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'author' => ['required', 'numeric'],
            'course_category_id' => ['required', 'numeric'],
            'course_level_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'course_icon_path' => ['required', 'image', 'max:5120'],
        ], [
            'avatar.mimes' => 'Разрешенные форматы: jpeg,png,jpg,svg.',
            'avatar.max' => 'Максимальный размер 5 мб.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        if ($request->file('course_icon_path')) {
            $validated['course_icon_path'] = $request->file('course_icon_path')->store('public/courses');
            //            $validated['course_banner_path'] = $request->file('course_banner_path')->store('public/images');
        }

        Course::query()->create($validated);

        return redirect(route('dashboard.courses'));
    }
}
