<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Lesson;
use Livewire\Component;

class LessonsShow extends Component
{

    public $lessons;

    public $search;

    public $error = '';

    protected $listeners = [
        'refreshComponent' => 'getLessons',
    ];

    public function searchLessons()
    {
        $this->lessons = Lesson::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function getLessons()
    {
        $this->lessons = Lesson::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function destroy($id)
    {
        try {
            Lesson::find($id)->delete();
            $this->emit('refreshComponent');
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting category!!");
        }
    }

    public function render()
    {
        $this->lessons = Lesson::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.dashboard.lessons-show');
    }
}
