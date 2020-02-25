<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
class Category extends Model
{
     use softDeletes;
	protected $guarded =[];
	protected $dates = ['deleted_at'];
	
	public function products(){
		return $this->belongsToMany('App\Product')->withTimeStamps();
	}
	
	public function children(){
		
		return $this->belongsToMany(Category::class,'category_perent','category_id','parent_id');
	}
}
