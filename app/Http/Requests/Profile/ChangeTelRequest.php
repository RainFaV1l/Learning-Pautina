<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangeTelRequest extends FormRequest
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
            'tel' => ['required', 'string', 'min:17', 'max:17', 'unique:users'],
        ];
    }

    public function messages()
    {
        return [
            'min' => 'Кол-во символов: :min.',
        ];
    }
}
