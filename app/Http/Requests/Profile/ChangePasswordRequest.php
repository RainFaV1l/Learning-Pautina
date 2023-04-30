<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password_old' => ['required', 'string', 'min:6'],
            'password_new' => ['required', 'string', 'min:6', 'same:password_r'],
            'password_r' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'min' => 'Кол-во символов: :min.',
            'same' => 'Пароли не совпадают.',
        ];
    }
}
