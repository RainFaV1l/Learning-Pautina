<?php

namespace App\Http\Middleware;

use App\Models\CourseUser;
use App\Models\Lesson;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsLessonPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lesson = Lesson::findOrFail($request->route()->parameter('lesson_id'));
        $checkLesson = CourseUser::where('course_id', '=', $lesson->course_id)->where('user_id', '=', Auth::user()->id)->get();
        $checkLesson = count($checkLesson);
        if(Auth::user()->role_id !== 3) {
            if($checkLesson === 0) {
                $checkCourse = count(Lesson::where('id', '=', $request->route()->parameter('id'))->get());
                if($checkCourse === 0) {
                    abort(404);
                }
                abort(403);
            }
        }
        return $next($request);
    }
}
