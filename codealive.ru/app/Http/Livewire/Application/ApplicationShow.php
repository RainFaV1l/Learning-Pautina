<?php

namespace App\Http\Livewire\Application;

use App\Models\CourseUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApplicationShow extends Component
{
    public Collection $applications;

    protected $listeners = ['resetApplications'];

    public function resetApplications() {
        $this->applications = CourseUser::query()->where('user_id', '=', Auth::user()->id)->get();
    }

    public function all()
    {
        $this->applications = CourseUser::query()->where('user_id', '=', Auth::user()->id)->get();
    }

    public function inProcessing()
    {
        $this->applications = CourseUser::query()
            ->where('user_id', '=', Auth::user()->id)
            ->where('course_users_status_id', '=', 2)
            ->get();
    }

    public function accepted()
    {
        $this->applications = CourseUser::query()
            ->where('user_id', '=', Auth::user()->id)
            ->where('course_users_status_id', '=', 3)
            ->get();
    }

    public function unsubscribe(CourseUser $application)
    {
        if ($application->course_users_status_id == 2) {
            $application->delete();
            $this->emit('resetApplications');
        }
    }

    public function mount() {
        $this->applications = CourseUser::query()->where('user_id', '=', Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.application.applicationsShow');
    }
}
