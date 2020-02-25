<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
     use softDeletes;
	
	protected $guarded = [];
	protected $dates = ['deleted_at'];
	
	public function categories(){
		return $this->belongsToMany('App\Category')->withTimeStamps();
	}
}
