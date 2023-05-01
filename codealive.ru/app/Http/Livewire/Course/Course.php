<?php

namespace App\Http\Livewire\Course;

use App\Models\Course as ModelsCourse;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use Livewire\Component;

class Course extends Component
{
    public $categories;
    public $courses;
    public $author;
    public $course_levels;

    public $level_id = null;
    public $category_id = null;

    protected $listeners = [
        'refreshLevels',
        'refreshCategories',
    ];

    public function refreshLevels() {
        $this->level_id = null;
    }

    public function refreshCategories() {
        $this->category_id = null;
    }

    public function render()
    {
        if($this->level_id === null && $this->category_id === null) {
            $this->courses = ModelsCourse::all();
        }
        elseif ($this->level_id !== null && $this->category_id === null) {
            $this->courses = ModelsCourse::where('course_level_id', '=', $this->level_id)->get();
        }
        elseif ($this->level_id === null && $this->category_id !== null) {
            $this->courses = ModelsCourse::where('course_category_id', '=', $this->category_id)->get();
        }
        elseif ($this->level_id !== null && $this->category_id !== null) {
            $this->courses = ModelsCourse::where('course_category_id', '=', $this->category_id)->where('course_level_id', '=', $this->level_id)->get();
        }
        return view('livewire.course.course');
    }

    public function mount()
    {
        $this->categories = CourseCategory::all();
        $this->course_levels = CourseLevel::all();
        $this->courses = ModelsCourse::all();
    }

    public function setLevelId($level_id) {
        $this->level_id = $level_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

//    public function filterLevel($level_id) {
//        if ($level_id === 0) {
//            $this->courses = ModelsCourse::all();
//        } else {
//            $this->courses = ModelsCourse::where('course_level_id', '=', $level_id)->get();
//
//        }
//    }
//
//    public function filterCategory($category_id) {
//        if ($category_id === 0) {
//            $this->courses = ModelsCourse::all();
//        } else {
//            $this->courses = ModelsCourse::where('course_category_id', '=', $category_id)->get();
//        }
//    }
}
