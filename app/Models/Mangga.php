<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mangga extends Model
{
    protected $table = 'manggas';
    protected $guarded = [];

    public function kelompok()
    {
    	return $this->belongsTo('App\Models\KelompokTani','id_kelompok');
    }

    public function retailer()
    {
    	return $this->belongsTo('App\Models\Retailer','id_retailer');
    }

    public function jenis()
    {
    	return $this->belongsTo('App\Models\JenisMangga','id_jenis');
    }
    public function grade()
    {
    	return $this->belongsTo('App\Models\Grade','id_grade');
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
