<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'body_en' => ['nullable', 'string'],
            'body_fr' => ['nullable', 'string'],
            'body_ar' => ['exclude_unless:step,0,2', 'required_without_all:body_en,body_fr', 'nullable', 'string'],			
        ];
    }

}