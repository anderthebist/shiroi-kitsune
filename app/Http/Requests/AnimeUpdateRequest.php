<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimeUpdateRequest extends FormRequest
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
            'original_title.required' => 'Введите оригинальное название',
            'categories.required' => 'Выберете категории',
            'categories.exists' => 'Некоторые из выбраных вами категорий не существуюют',
            'voices.required' => 'Выберете даберов',
            'voices.exists' => 'Некоторые из выбраных вами даберов не существуюют',
            'studio_id.required' => 'Выберете студию',
            'studio_id.exist' => 'Такой студии не существует',
            'year.required' => 'Введите год',
            'year.number' => 'Введенный вами год не являеться числом',
            'type.required' => 'Введите тип',
            'producer.required' => 'Введите режиссёра',
            'contry.required' => 'Введите страну',
            'timing.required' => 'Введите таймера',
            'image.mimes' => "Файл картинки не в нужном формате: png,jpg",
            'image.max' => "Максимальный размер картинки не долже привышать 2 мб",
            'poster.mimes' => "Файл постера не в нужном формате: png,jpg",
            'poster.max' => "Максимальный размер постера не долже привышать 2 мб",
            'logo.mimes' => "Файл логотипа не в нужном формате: png,jpg",
            'logo.max' => "Максимальный размер логотипа не долже привышать 2 мб",
            'transfer.required' => "Введите переводчика",
            'description.required' => "Введите описание",
            'planned_series.required' => "Введите количество запланированых серий",
            'trailer.url' => "Ссылка на трейлер не является валидной"
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
            'title' => ['required'],
            'original_title' => ['required'],
            'image' => ["nullable" ,"mimes:jpg,png","max:2048"],
            'categories'=> ['required', 'array', 'min:1', 'exists:categories,id'],
            'voices'=> ['required', 'array', 'min:1', 'exists:voices,id'],
            'studio_id' => ['required', 'exists:studios,id'],
            'type' => ['required'],
            'year' => ['required', 'numeric', 'min:2000'],
            'producer' => ['required'],
            'timing' => ['required'],
            'contry' => ['required'],
            'transfer' => ['required'],
            'planned_series' => ['required', 'numeric'],
            'description' => ['required'],
            'poster' => ["nullable", "mimes:jpg,png","max:2048"],
            'logo' => ["nullable", "mimes:jpg,png","max:2048"],
            'trailer' => ["nullable", 'url'],
        ];
    }
}
