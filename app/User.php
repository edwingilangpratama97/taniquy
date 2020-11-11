<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function kelompok()
    {
        return $this->belongsTo('App\Models\KelompokTani','id_kelompok');
    }

    public function retailer()
    {
        return $this->belongsTo('App\Models\Retailer','id_retailer');
    }

    public function enduser()
    {
        return $this->belongsTo('App\Models\Enduser','id_enduser');
    }
}
