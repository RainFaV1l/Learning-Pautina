<?php

namespace App\Http\Livewire\Course;

use App\Models\Course as CourseAlias;
use App\Models\CourseCategory;
use App\Models\CourseLevel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CourseUpdate extends Component
{
    use WithFileUploads;

    public $users;
    public $categories;
    public $course;
    public $levels;
    public $course_id;

    public $name;
    public $price;
    public $author;
    public $course_category_id;
    public $course_level_id;
    public $description;
    public $course_icon_path;
    public $course_banner_path;

    protected $listeners = [
        'refreshComponent' => 'getCourse',
    ];

    protected $rules = [
        'name' => ['required', 'string'],
        'price' => ['required', 'numeric', 'max:1000000'],
        'author' => ['required', 'numeric'],
        'course_category_id' => ['required', 'numeric'],
        'course_level_id' => ['required', 'numeric'],
        'description' => ['required', 'string'],
    ];

    public function getCourse() {
        $this->course = CourseAlias::findOrFail($this->course_id);
    }

    public function update($id)
    {
        $validated = $this->validate($this->rules);

        if ($this->course_icon_path) {
            $validated['course_icon_path']  = $this->validate([
                'course_icon_path' => ['required', 'image', 'max:5120'],
            ]);
            $validated['course_icon_path'] = $this->course_icon_path->store('public/images');
        }

        if ($this->course_banner_path) {
            $validated['course_banner_path']  = $this->validate([
                'course_banner_path' => ['required', 'image', 'max:5120'],
            ]);
            $validated['course_banner_path'] = $this->course_banner_path->store('public/images');
        }

        CourseAlias::query()->where('id', '=', $id)->update($validated);

        $this->emit('refreshComponent');
    }

    public function render()
    {
        $this->users = User::all();
        $this->categories = CourseCategory::all();
        $this->levels = CourseLevel::all();
        return view('livewire.admin.course.editForm');
    }

    public function mount()
    {
        $this->course = CourseAlias::findOrFail($this->course_id);
        $this->name = $this->course->name;
        $this->price = $this->course->price;
        $this->author = $this->course->author;
        $this->course_category_id = $this->course->course_category_id;
        $this->course_level_id = $this->course->course_level_id;
        $this->description = $this->course->description;
    }
}
