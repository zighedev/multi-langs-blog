<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Tag extends Model implements TranslatableContract
{
	use Translatable;
    use HasFactory;
	
	public $translatedAttributes = ['name', 'description'];
	protected $fillable = ['id'];
	protected $hidden = ['pivot', 'translations', 'created_at', 'updated_at'];
	
	
	### relations ###
	
	public function articles(){
        return $this->belongsToMany('App\Models\Article', 'article_tag');
    }
	
}
