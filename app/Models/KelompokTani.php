<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    protected $table = 'kelompok_tanis';
    protected $guarded = [];

    public function desa()
    {
    	return $this->belongsTo('App\Models\Desa','id_desa');
    }

    public function mangga()
    {
    	return $this->hasMany('App\Models\Mangga');
    }

    public function penawaran()
    {
    	return $this->hasMany('App\Models\Penawaran');
    }

    public function postingan()
    {
    	return $this->hasMany('App\Models\Postingan');
    }
}
