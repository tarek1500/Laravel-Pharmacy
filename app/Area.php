<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name',
        'address'
    ];

    public function pharmacies()
    {
        return $this->hasMany('App\Pharmacy');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');

    }
}
