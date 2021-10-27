<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamUpdateRequest extends FormRequest
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
            'image.mimes' => "Файл картинки не в нужном формате: png,jpg",
            'image.max' => "Максимальный размер картинки не долже привышать 2 мб",
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'image' => ["nullable" ,"mimes:jpg,png","max:2048"],
            'status' => ["nullable"],
            'description' => ["nullable"]
        ];
    }
}
