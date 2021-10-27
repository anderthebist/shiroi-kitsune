<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name.required' => 'Введите название категории',
            'name.unique' => 'Такое название категории уже существует',
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:categories']
        ];
    }
}
