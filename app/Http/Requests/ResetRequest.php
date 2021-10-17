<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
            'token.required'=> "Ошибка сервера",
            'token.exists'=> "Ошибка сервера",
            'password.required' => "Заполните пароль",
            'password.confirmed' => "Пароли должны быть идентичны"
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
            'token' => ['required','exists:users,token'],
            'password' => ['required','confirmed']
        ];
    }
}
