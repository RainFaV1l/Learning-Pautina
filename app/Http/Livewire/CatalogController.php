<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\GroupModule;
use App\Models\LessonModule;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        return view('livewire.catalog');
    }

    public function show($id)
    {
        $allLessonsCount = 0;
        $course = Course::findOrFail($id);
        $course_modules = GroupModule::query()
            ->where('course_id', '=', $id)
            ->orderBy('module_number')->get();
        foreach ($course_modules as $course_module) {
            $allLessonsCount = $allLessonsCount + LessonModule::query()->where('module_id', '=', $course_module->id)->count();
        }
        return view('livewire.course.one-course', compact('course_modules', 'course', 'allLessonsCount'));
    }
}
