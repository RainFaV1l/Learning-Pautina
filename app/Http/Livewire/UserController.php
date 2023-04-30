<?php


namespace App\Http\Livewire;

use App\Http\Requests\Profile\ChangeAvatarRequest;
use App\Http\Requests\Profile\changeEmailRequest;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\changePersonalInfoRequest;
use App\Http\Requests\Profile\ChangeTelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function index()
    {

        $user = User::getInfo(Auth::id());

        return view('livewire.profile.profile', compact('user'));

    }

    public function changeAvatar(ChangeAvatarRequest $request)
    {

        $validated = $request->validated();

        $this->service->changeAvatar($request, $validated);

        return redirect(route('profile.index'));

    }

    public function changePersonalInfo(changePersonalInfoRequest $request)
    {

        $validated = $request->validated();

        $this->service->changeAvatar($validated);

        return redirect(route('profile.index'));
    }

    public function changeEmail(changeEmailRequest $request)
    {

        $validated = $request->validated();

        $this->service->changeAvatar($validated);

        return redirect(route('profile.index'));

    }

    public function changeTel(ChangeTelRequest $request)
    {


//        $validator = Validator::make($request->all(), [
//            'tel' => ['required', 'string', 'min:17', 'max:17', 'unique:users'],
//        ], [
//            'min' => 'Кол-во символов: :min.',
//        ]);

//        if ($validator->fails()) {
//            return back()->withErrors($validator->errors())->withInput($request->all());
//        }

        $validated = $request->validated();

        $this->service->changeTel($request, $validated);

        return redirect(route('profile.index'));

    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {

        $validated = $request->validated();

        $this->service->changePassword($request, $validated);

        return redirect(route('profile.index'));

    }
}
