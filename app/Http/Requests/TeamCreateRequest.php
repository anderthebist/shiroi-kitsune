<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamCreateRequest extends FormRequest
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
            'name.required' => 'Введите имя',
            'name.unique' => 'Такое имя учасника уже существует',
            'image.mimes' => "Файл картинки не в нужном формате: png,jpg",
            'image.max' => "Максимальный размер картинки не долже привышать 2 мб",
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:voices'],
            'image' => ["nullable" ,"mimes:jpg,png","max:2048"],
            'status' => ["nullable"],
            'description' => ["nullable"]
        ];
    }
}
