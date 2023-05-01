<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\CourseCategory;
use Livewire\Component;

class CategoryShow extends Component
{
    public $categories;
    public $search;

    protected $listeners = [
        'refreshCategories' => 'getCategories',
    ];

    public function getCategories() {
        $this->categories = CourseCategory::all();
    }

    public function searchCategories()
    {
        $this->categories = CourseCategory::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        $this->categories = CourseCategory::where('name', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.dashboard.category-show');
    }
}
