<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	
	
	protected $fillable = [
        'name',
        'email',
		'comment',
		'article_id',
    ];
	
	protected $hidden = ['email', 'updated_at', 'article_id'];
	
	
	### local scopes ###
	public function scopeHasEmail($builder){
        $builder->where('email', '!=', NULL);
    }
	
	public function scopeDoesntHaveEmail($builder){
        $builder->where('email', NULL);
    }
	
	

    ### relations ###
    public function article(){
        return $this->belongsTo('App\Models\Article');
    }
	
}
