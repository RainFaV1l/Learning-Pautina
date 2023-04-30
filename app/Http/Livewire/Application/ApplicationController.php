<?php

namespace App\Http\Livewire\Application;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;

class ApplicationController extends Controller
{
    public function index() {
        return view('livewire.application.applications');
    }

    public function create() {
        $users = User::all();
        $courses = Course::all();
        $groups = Group::all();
        return view('livewire.application.create', compact('users', 'courses', 'groups'));
    }
}
