<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\CourseUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsCourseStudent
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
        $checkSubscribe = CourseUser::where('user_id', '=', Auth::user()->id)
            ->where('course_id', '=', $request->route()->parameter('id'))
            ->where('course_users_status_id', '=', 3)->get();
        $checkSubscribe = count($checkSubscribe);
        if(Auth::user()->role_id !== 3) {
            if($checkSubscribe === 0) {
                $checkCourse = count(Course::where('id', '=', $request->route()->parameter('id'))->get());
                if($checkCourse === 0) {
                    abort(404);
                }
                abort(403);
            }
        }
        return $next($request);
    }
}
