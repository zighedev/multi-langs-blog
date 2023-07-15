<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'unique:sub_categories,name_en,'.$this->sub_category, 'max:50'],
            'name_fr' => ['required', 'string', 'unique:sub_categories,name_fr,'.$this->sub_category, 'max:50'],
            'name_ar' => ['required', 'string', 'unique:sub_categories,name_ar,'.$this->sub_category, 'max:50'],
			'title_en' => ['nullable', 'string', 'max:50'],
			'title_fr' => ['nullable', 'string', 'max:50'],
			'title_ar' => ['nullable', 'string', 'max:50'],
			'description_en' => ['nullable', 'string', 'max:150'],
			'description_fr' => ['nullable', 'string', 'max:150'],
			'description_ar' => ['nullable', 'string', 'max:150'],
			'visibility' => ['nullable'],
			'category_id' => ['required', 'numeric', 'exists:categories,id'],
        ];
    }
	
	
}