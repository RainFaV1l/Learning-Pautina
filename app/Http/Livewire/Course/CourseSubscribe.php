<?php

namespace App\Http\Livewire\Course;

use App\Models\CourseUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseSubscribe extends Component
{
    public $course_id;


    public function subscribe()
    {
        if (isset(Auth::user()->id) && !empty($this->course_id)) {

            // Проверка отправлял ли пользователь заявку
            $application = CourseUser::query()->where('user_id', '=', Auth::user()->id)->where('course_id', '=', $this->course_id)->count();
            if($application === 0) {
                CourseUser::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $this->course_id,
                ]);
                $this->emit('redirect', '/applications');
            }
        }
    }

    public function render()
    {
        return view('livewire.course.course-subscribe');
    }
}
