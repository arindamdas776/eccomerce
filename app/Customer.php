<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Customer extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];
}
