<?php

namespace App\Http\Livewire\Module;

use App\Models\Lesson;
use App\Models\LessonModule;
use Livewire\Component;

class ModuleStoreLesson extends Component
{
    public $lessons;
    public $lesson_id;
    public $module_id;

    protected $rules = [
        'lesson_id' => ['required', 'numeric'],
        'module_id' => ['required', 'numeric'],
    ];

    public function render()
    {
        $this->lessons = Lesson::query()
            ->select('lessons.id', 'lessons.name')
            ->whereNotIn('id',
                LessonModule::select('lesson_id')
                    ->where('module_id', '=', $this->module_id)
            )
            ->get();
        return view('livewire.admin.module.storeLesson');
    }

    public function store() {
        $validated = $this->validate($this->rules);
        LessonModule::create($validated);
//        return redirect()->to('/dashboard/modules/' . $this->module_id . '/more');
    }
}
