<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Profile extends Model
{
     use softDeletes;
	 
	protected $guarded  = [];
	protected $dates = ['deleted_at'];
}
