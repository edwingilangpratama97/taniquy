<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
   	protected $table = 'pemesanans';
    protected $guarded = [];

    public function postingan()
    {
    	return $this->belongsTo('App\Models\Postingan','id_postingan');
    }

    public function enduser()
    {
    	return $this->belongsTo('App\Models\Enduser','id_enduser');
    }

    public function retailer()
    {
    	return $this->belongsTo('App\Models\Retailer','id_retailer');
    }
}
