<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VidoeCreateRequest extends FormRequest
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
            'anime_id.required' => 'Выберете релиз',
            'anime_id.exist' => 'Такого релиза не существует',
            'number_video.required' => 'Введите номер серии',
            'number_video.numeric' => 'Введенный вами номер не являеться числом',
            'content.required' => "Введите ссылку на видео"
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
            'anime_id' => ['required', 'exists:anime,id'],
            'number_video' => ['required', 'numeric'],
            'content' => ["required"]
        ];
    }
}
