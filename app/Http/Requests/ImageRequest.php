<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'image' => ['image', 'mimes:jpeg,jpg,png', 'max:4096'],
			'order' => ['required', 'numeric'],
			'alt_en' => ['nullable', 'string', 'max:50'],
			'alt_fr' => ['nullable', 'string', 'max:50'],
			'alt_ar' => ['nullable', 'string', 'max:50'],
        ];
    }

}