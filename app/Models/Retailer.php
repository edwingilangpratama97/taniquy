<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $table = 'retailers';
    protected $guarded = [];

    public function kebutuhan()
    {
    	return $this->hasMany('App\Models\Kebutuhan');
    }

    public function mangga()
    {
    	return $this->hasMany('App\Models\Mangga');
    }

    public function pemesanan()
    {
    	return $this->hasMany('App\Models\Pemesanan');
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
