<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kebutuhan extends Model
{
    protected $table = 'kebutuhans';
    protected $guarded = [];

    public function enduser()
    {
    	return $this->belongsTo('App\Models\Enduser','enduser_id');
    }

    public function retailer()
    {
    	return $this->belongsTo('App\Models\Retailer','id_retailer');
    }

    public function penawaran()
    {
    	return $this->hasMany('App\Models\Penawaran');
    }
}
