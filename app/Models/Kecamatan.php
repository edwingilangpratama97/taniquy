<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatans';
    protected $guarded = [];

    public function desa()
    {
    	return $this->hasMany('App\Models\Desa');
    }

    public function kabupaten()
    {
    	return $this->belongsTo('App\Models\Kabupaten','kabupaten_id');
    }
}
