<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
    	return "slug";
    }
    
}
