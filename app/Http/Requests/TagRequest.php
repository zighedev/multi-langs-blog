<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $data = [];
		
		foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){						
			$data[$localeCode.'.name'] 	= ['required', 'string', 'max:255', Rule::unique('tag_translations', 'name')
																			->where(function($q) use ($localeCode){
																				$q->where('locale', $localeCode)->where('tag_id', '!=', $this->tag);
																			})];
			$data[$localeCode.'.description'] 	= ['nullable', 'string', 'max:255'];
		}
		
        return $data;
    }

}