<?php

namespace App\Http\Middleware;

use App\Models\LessonModule;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckIsIsUserModule
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
        $check = LessonModule::query()
            ->join('user_modules', 'lesson_modules.module_id', 'user_modules.module_id')
            ->where('lesson_modules.lesson_id', '=', Route::current()->lesson_id)
            ->where('lesson_modules.module_id', '=', Route::current()->module_id)
            ->where('user_modules.student_id', '=', Auth::user()->id)
            ->get();
        if($check->count() === 0 and Auth::user()->role_id != 3) {
            abort(403);
        }
        return $next($request);
    }
}
