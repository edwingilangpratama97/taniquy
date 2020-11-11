<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupatens';
    protected $guarded = [];

    public function kecamatan()
    {
    	return $this->hasMany('App\Models\Kecamatan');
    }

    public function provinsi()
    {
    	return $this->belongsTo('App\Models\Provinsi','provinsi_id');
    }
}
