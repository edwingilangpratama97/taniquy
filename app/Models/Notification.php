<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function penawaran()
    {
        return $this->belongsTo('App\Models\Penawaran','id_penawaran','id');
    }
    public function pemesanan()
    {
        return $this->belongsTo('App\Models\Pemesanan','id_pemesanan');
    }
}
