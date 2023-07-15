<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
	
	use Translatable;
    use HasFactory;

	public $translatedAttributes = ['name', 'description'];
	protected $fillable = ['visibility', 'ads',	'parent'];
	protected $hidden = ['visibility', 'ads', 'created_at', 'updated_at', 'translations'];
	
	
	### local scopes ###	
	public function scopeVisible($builder){
        $builder->where('visibility', 1);
    }
	public function scopeInvisible($builder){
        $builder->where('visibility', 0);
    }
	public function scopeAdsAllowed($builder){
        $builder->where('ads', 1);
    }
	public function scopeAdsNotAllowed($builder){
        $builder->where('ads', 0);
    }
	public function scopeIsParent($builder){
        $builder->where('parent', null);
    }
	
	
	### relations ###
	
    public function parentCategory(){
        return $this->belongsTo('App\Models\Category', 'parent');
    }
	
	public function children(){
        return $this->hasMany('App\Models\Category', 'parent');
    }
	
	public function articles(){
        return $this->hasMany('App\Models\Article');
    }
	
}
