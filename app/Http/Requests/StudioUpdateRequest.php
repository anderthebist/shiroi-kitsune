<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudioUpdateRequest extends FormRequest
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
            'name.required' => 'Введите название студии'
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required']
        ];
    }
}
