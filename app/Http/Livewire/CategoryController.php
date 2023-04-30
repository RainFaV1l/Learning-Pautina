<?php

namespace App\Http\Livewire;

use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CategoryController extends Component
{
    public function addView() {
        return view('livewire.admin.category.addCategory');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        CourseCategory::query()->create($validated);

        return redirect(route('dashboard.categories'));
    }

    public function editView($id) {
        $category = CourseCategory::findOrFail($id);
        return view('livewire.admin.category.editCategory', compact('category'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ], [
            'name.string' => 'Введите строку.',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        CourseCategory::query()->where('id', '=', $id)->update($validated);

        return redirect(route('dashboard.categories'));
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'numeric'],
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all);
        }
        $validated = $validator->validated();
        CourseCategory::destroy($validated['category_id']);
        return redirect(route('dashboard.categories'));
    }
}
