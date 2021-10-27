<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
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
            'title.required' => 'Введите название релиза',
            'image.mimes' => "Файл картинки не в нужном формате: png,jpg",
            'image.max' => "Максимальный размер картинки не долже привышать 2 мб",
            'vidoe.url' => "Ссылка на трейлер не является валидной",
            'author.required' => "Введите автора",
            "text.required"=> "Введите текст новости"
        ];
    }

    public function rules()
    {
        return [
            'title' => ['required'],
            'image' => ["nullable" ,"mimes:jpg,png","max:2048"],
            'vidoe' => ["nullable", 'url'],
            'author' => ["required"],
            'text' => ['required']
        ];
    }
}
