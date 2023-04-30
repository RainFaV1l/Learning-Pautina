<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CourseShow extends Component
{
    public $courses;
    public $search;

    protected $listeners = [
        'refreshComponent' => 'getCourses',
    ];

    public function searchCourses()
    {
        $this->courses = Course::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function getCourses()
    {
        $this->courses = Course::all();
    }

    public function destroy($id)
    {
        try {
            Course::find($id)->delete();
            $this->emit('refreshComponent');
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting category!!");
        }
    }

    public function render()
    {
        $this->courses = Course::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.dashboard.course-show');
    }
}
