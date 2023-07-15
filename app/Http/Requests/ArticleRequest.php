<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ArticleRequest extends FormRequest
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
		
        $data = [
			'step' => ['required', 'numeric', 'between:0,6'],
			'parent' => ['exclude_unless:step,0,1', 'required', 'numeric', 'exists:categories,parent'],// category (parent)
			'category_id' => ['exclude_unless:step,0,2', 'required', 'numeric', 'exists:categories,id'],// subcategory			
			'tags' => ['exclude_unless:step,0,5', 'array', 'exists:tags,id'],
			'image'  => ['sometimes', 'image', 'mimes:jpeg,jpg,png', 'max:4096'],
        ];
		
		foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
			
			$data[$localeCode.'.title'] = ['exclude_unless:step,0,3', 'required', 'string', 'max:255', 
											Rule::unique('article_translations', 'title')
											->where(function($q) use ($localeCode){
												$q->where('locale', $localeCode)->where('article_id', '!=', $this->article);
											})];
										
			$data[$localeCode.'.content'] = ['nullable', 'string'];	
			$data[$localeCode.'.description'] = ['nullable', 'string', 'max:255'];
			$data[$localeCode.'.image_description'] = ['nullable', 'string', 'max:255'];
		}
		
		return $data;
    }
	
	
}