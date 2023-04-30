<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->authorize('view-admin-dashboard', [self::class]);
    }

    public function index()
    {
        return view('livewire.admin.dashboard.dashboard');
    }

    public function courses()
    {
        return view('livewire.admin.dashboard.dashboard-courses');
    }

    public function lessons()
    {
        return view('livewire.admin.dashboard.dashboard-lessons');
    }

    public function categories()
    {
        return view('livewire.admin.dashboard.dashboard-categories');
    }

    public function users()
    {
        return view('livewire.admin.dashboard.dashboard-users');
    }

    public function groups()
    {
        return view('livewire.admin.dashboard.dashboard-groups');
    }

    public function applications()
    {
        return view('livewire.admin.dashboard.dashboard-applications');
    }
    
    public function modules() {
        return view('livewire.admin.dashboard.dashboard-modules');
    }
}
