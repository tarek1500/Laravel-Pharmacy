<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'image',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
