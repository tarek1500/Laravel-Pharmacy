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

     public function prescriptions()
     {
        return $this->hasMany('App\Prescription');

     }

     public function doctor()
     {
         return $this->belongsTo('App\Doctor');
     }

     public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }
    public function address()
    {
        return $this->belongsTo('App\Address','delivering_address_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','order_user_id');
    }
}
