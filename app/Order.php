<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'delivering_address_id',
        'doctor_id',
        'is_insured',
        'status_id',
        'pharamcy_id',
        'order_user_id',
        'creator_type',
        'total_price',
    ];
    static public $statuses =[
        'New',
        'Processing',
        'WaitingForUserConfirmation',
        'Canceled',
        'Confirmed',
        'Delivered'

    ];

   
     // The orders that contain the medicine.

     public function medicines()
     {   //many to many

         return $this->belongsToMany(Medicine::class,'medicine_orders');
     }
}
