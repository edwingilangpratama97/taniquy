<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $table = 'postingans';
    protected $guarded = [];

    public function pemesanan()
    {
    	return $this->hasMany('App\Models\Pemesanan');
    }

    public function mangga()
    {
    	return $this->belongsTo('App\Models\Mangga','id_mangga');
    }

    public function kelompok()
    {
    	return $this->belongsTo('App\Models\KelompokTani','id_kelompok');
    }

    public function retailer()
    {
    	return $this->belongsTo('App\Models\Retailer','retailer_id');
    }
}
