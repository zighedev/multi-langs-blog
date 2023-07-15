<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use phpDocumentor\Reflection\Types\Self_;

class Setting extends Model implements TranslatableContract
{
	
	use Translatable;
    use HasFactory;
	
	public $translatedAttributes = ['site_name', 'description', 'notification'];
	protected $fillable = ['phone', 'email', 'youtube', 'facebook', 'instagram', 'twitter'];
	protected $hidden = ['translations'];
	
	public static function getStettingsOrCreate(){

		$settings = Self::all();
		
		if(count($settings) < 1){
			$data = [];
			foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
				$data[$localeCode]['description'] = null;
			}
			Self::create($data);
		}
		
		return Self::first();
	}
	
	
}
