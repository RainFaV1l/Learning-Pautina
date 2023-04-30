<?php

namespace App\Http\Livewire\Course;

// use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CourseDeleteModal extends ModalComponent
{
    public $course_id;

    public function render()
    {
        return view('livewire.course.course-delete-modal');
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}
