<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;

class IndexController extends Controller
{
    public function index()
    {
        $popularCourses = CourseUser::query()
            ->select('courses.id as course_id')
            ->selectRaw('COUNT(course_users.course_id) as count')
            ->rightJoin('courses', 'course_users.course_id', '=', 'courses.id')
            ->groupBy('course_users.course_id')
            ->orderBy('count', 'desc')
            ->take(4)->get();
        return view('livewire.index', compact('popularCourses'));
    }
}
