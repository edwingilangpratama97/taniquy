<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsis';
    protected $guarded = [];

    public function kabupaten()
    {
    	return $this->hasMany('App\Models\Kabupaten');
    }
}
