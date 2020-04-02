<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];
    
    // The pharmacies that contain the medicine.

    public function pharmacies()
    {   //many to many 

        return $this->belongsToMany(Pharmacy::class,'medicine_pharmacies');
    }
    

     // The orders that contain the medicine.

     public function orders()
     {   //many to many

         return $this->belongsToMany(Order::class,'medicine_orders');
     }
     
}
