<?php

namespace App\Services\Profile;

use App\Http\Requests\Profile\ChangeAvatarRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Service
{
    public function changeAvatar($request, $validated) {

        if ($request->file('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('avatars', 'public');
        }

        User::query()->where('id', '=', Auth::user()->id)->update(['profile_photo_path' => 'public/' . $path]);

    }

    public function changePersonalInfo($validated) {

        User::query()->where('id', '=', Auth::user()->id)->update($validated);

    }

    public function changeEmail($validated) {

        $validated['password'] = Hash::make($validated['password']);

        $user = User::query()->select('password')->find(Auth::id());

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['invalid_email' => 'Неверный пароль.']);
        }

        $user::query()->where('id', '=', Auth::user()->id)->update($validated);

    }

    public function changeTel($request, $validated) {

        $validated['password'] = Hash::make($request['password_tel']);

        $user = User::query()->select('password')->find(Auth::id());

        if (!Hash::check($request['password_tel'], $user->password)) {
            return back()->withErrors(['invalid_tel' => 'Неверный пароль.'])->withInput($request->all());
        }

        $user::query()->where('id', '=', Auth::user()->id)->update($validated);

    }

    public function changePassword($request, $validated) {

        $validated['password'] = Hash::make($request['password_new']);

        $user = User::query()->select('password')->find(Auth::id());

        if (!Hash::check($request['password_old'], $user->password)) {
            return back()->withErrors(['invalid_password' => 'Неверный пароль.'])->withInput($request->all());
        }

        $user::query()->where('id', '=', Auth::user()->id)->update($validated);

        return redirect(route('profile.index'));

    }

}
