<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UserShow extends Component
{
    public Collection $users;
    public $search;

    public $getAllUsers = true;
    public $getNewUsers = false;
    public $getNoCourseUsers = false;

    public function mount() {
        $this->users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('surname', 'like', '%' . $this->search . '%')
            ->orWhere('patronymic', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')->get();
    }

    public function getAllUsers()
    {
        $this->getAllUsers = true;
        $this->getNewUsers = false;
        $this->getNoCourseUsers = false;
    }

    public function getNewUsers()
    {
        $this->getNewUsers = true;
        $this->getAllUsers = false;
        $this->getNoCourseUsers = false;
    }

    public function getNoCourseUsers()
    {
        $this->getNoCourseUsers = true;
        $this->getNewUsers = false;
        $this->getAllUsers = false;
    }

    public function searchUsers()
    {
        $this->users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('surname', 'like', '%' . $this->search . '%')
            ->orWhere('patronymic', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')->get();
    }

    public function render()
    {
        if($this->getAllUsers === true) {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')
                ->where('surname', 'like', '%' . $this->search . '%')
                ->orWhere('patronymic', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')->get();
        }
        else if($this->getNewUsers === true) {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')
                ->where('surname', 'like', '%' . $this->search . '%')
                ->orWhere('patronymic', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')->latest('created_at')->get();
        }
        else if($this->getNoCourseUsers === true) {
            // SELECT * FROM `users` LEFT OUTER JOIN `course_users` ON users.id = course_users.user_id WHERE course_users.user_id IS NULL;
            $this->users = User::query()->select('users.id', 'surname', 'name', 'patronymic', 'email', 'group_id', 'role_id')
                ->leftJoin('course_users', 'users.id', '=', 'course_users.user_id')
                ->whereNull('course_users.user_id')
                ->where(function ($query) {
                    $query->where('surname', 'like', '%' . $this->search . '%')
                    ->orWhere('patronymic', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')->latest('created_at')->get();
                })
                ->get();
        }
        return view('livewire.admin.user.user-show');
    }
}
