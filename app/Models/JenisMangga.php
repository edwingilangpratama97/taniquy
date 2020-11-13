<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisMangga extends Model
{
    protected $table = 'jenis_manggas';
    protected $guarded = [];

    public function mangga()
    {
    	return $this->hasMany('App\Models\Mangga');
    }

    public function kebutuhan()
    {
        return $this->hayMany('App\Models\Kebutuhan');
    }
}
