<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required' => "Заполните email адресс",
            'email.exists' => "Данного email адресса не существует",
            'email.email' => "Введенный вами email не является валидным",
            'email.string' => "Email адресс должен быть строковым",
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required','email', 'string', 'exists:users,email']
        ];
    }
}
