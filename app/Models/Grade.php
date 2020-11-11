<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $guarded = [];

    public function mangga()
    {
    	return $this->hasMany('App\Models\Mangga');
    }
}
