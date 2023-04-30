<?php

namespace App\Http\Livewire\Course;

use App\Models\Course as CourseAlias;
use Livewire\Component;

class CourseDelete extends Component
{
    public $course_id;
    public $courses;

    public function render()
    {
        return view('livewire.course.course-delete', ['course_id' => $this->course_id]);
    }

    public function destroy(CourseAlias $course) {
        try {
            $course->delete();
        } catch(\Exception $e) {
            session()->flash('error', "Something goes wrong while deleting category!!");
        }
    }
}
