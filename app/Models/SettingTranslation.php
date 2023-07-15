<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

	public $timestamps = false;
	protected $fillable = ['site_name', 'description', 'notification'];
	protected $hidden = ['id', 'locale'];
	
}
