<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class GroupController extends Component
{
    public function addView()
    {
        $teachers = User::query()->where('role_id', '=', 2)->get();
        return view('livewire.admin.group.addGroup', compact('teachers'));
    }

    public function editView($id)
    {
        $teachers = User::query()->where('role_id', '=', 2)->get();
        $group = Group::findOrFail($id);
        return view('livewire.admin.group.editGroup', compact('teachers', 'group'));
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'teacher_id' => ['required', 'numeric']
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        Group::query()->create($validated);

        return redirect(route('dashboard.groups'));
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'teacher_id' => ['required', 'numeric']
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        Group::query()->where('id', '=', $id)->update($validated);

        return redirect(route('dashboard.groups'));
    }

    public function destroy(Request $request) {

        $validator = Validator::make($request->all(), [
            'group_id' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput($request->all());
        }

        $validated = $validator->validated();

        Group::destroy($validated['group_id']);

        return redirect(route('dashboard.groups'));
    }
}
