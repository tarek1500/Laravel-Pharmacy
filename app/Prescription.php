<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImageAttribute($value){
        return $value ? Storage::url($value) : null;
    }
}
