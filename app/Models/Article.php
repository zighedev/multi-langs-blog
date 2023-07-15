<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Article extends Model implements TranslatableContract
{
	
	use Translatable;
    use HasFactory;
	
	public $translatedAttributes = ['title', 'content', 'description', 'image_description'];
	protected $fillable = ['image', 'views', 'approval', 'user_id', 'category_id'];
	protected $hidden = ['pivot', 'translations'];
	
	
	### local scopes ###
	public function scopeWatched($builder){
        $builder->where('views', '!=', 0);
    }
	
	public function scopeNotBeenWatched($builder){
        $builder->where('views', 0);
    }
	
	public function scopeApproved($builder){
        $builder->where('approval', 1);
    }
	
	public function scopeNotApproved($builder){
        $builder->where('approval', 0);
    }
		
		
	
	
	### relations ###
	
	public function category(){
        return $this->belongsTo('App\Models\Category');
    }
		
	public function user(){
        return $this->belongsTo('App\Models\User');
    }	
    
	public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
	
	public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'article_tag');
    }
	
}
