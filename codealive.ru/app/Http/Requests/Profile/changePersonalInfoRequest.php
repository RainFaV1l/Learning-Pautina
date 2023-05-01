<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class changePersonalInfoRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'surname' => ['required', 'string',  'min:2', 'max:255'],
            'name' => ['required', 'string',  'min:2', 'max:255'],
            'patronymic' => ['required', 'string',  'min:2', 'max:255'],
            'birthday_date' => ['required', 'date', 'max:255'],
        ];
    }

    public function messages():array
    {
        return [
            'min' => 'Минимум символов: :min.',
        ];
    }
}
