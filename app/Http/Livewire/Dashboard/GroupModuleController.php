<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupModuleController extends Controller
{
    public function add() {
        return view('livewire.admin.module.add');
    }
    public function edit($module_id) {
        return view('livewire.admin.module.edit', compact('module_id'));
    }
    public function more($module_id) {
        return view('livewire.admin.module.more', compact('module_id'));
    }
    public function addLesson($module_id) {
        return view('livewire.admin.module.addLesson', compact('module_id'));
    }
}
