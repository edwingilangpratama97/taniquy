<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    protected $table = 'penawarans';
    protected $guarded = [];

    public function kebutuhan()
    {
    	return $this->belongsTo('App\Models\Kebutuhan','id_kebutuhan');
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
    	return $this->belongsTo('App\Models\Retailer','id_retailer');
    }
    public function penawaran()
    {
        return $this->hasOne('App\Models\Notification','id_penawaran');
    }
}
