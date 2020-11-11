<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'desas';
    protected $guarded = [];
    
    public function kelompok()
    {
    	return $this->hasMany('App\Models\KelompokTani');
    }

    public function kecamatan()
    {
    	return $this->belongsTo('App\Models\Kecamatan','kecamatan_id');
    }
}
