<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enduser extends Model
{
    protected $table = 'endusers';
    protected $guarded = [];

    public function desa()
    {
    	return $this->belongsTo('App\Models\Desa','id_desa');
    }

    public function kebutuhan()
    {
    	return $this->hasMany('App\Models\Kebutuhan');
    }

    public function pemesanan()
    {
    	return $this->hasMany('App\Models\Pemesanan');
    }
}
