<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingRequest extends FormRequest
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
		$data = [
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'youtube' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url']       
		];
		
		foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
			$data[$localeCode.'.site_name'] 	= ['required', 'string', 'max:255'];
			$data[$localeCode.'.description'] 	= ['nullable', 'string', 'max:255'];
			$data[$localeCode.'.notification'] = ['required', 'string'];			
		}
		
        return $data;
    }

}