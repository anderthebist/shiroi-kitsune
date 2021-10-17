<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'anime_id' => ['required','exists:anime,id'],
            'text'=> ['required', 'string', 'max: 300'],
            'parent_id'=> ['nullable', 'exists:coments,id']
        ];
    }
}
