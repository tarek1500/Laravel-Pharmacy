<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'avatar_image',
        'priority',
        'area_id',
    ];
    protected $hidden = [
        'password',
    ];

    
     public function area()
    {
         return $this->belongsTo('App\Area');
    } 

      
    // The medicines that belong to the pharmacy.
    
    public function medicines()
    {  //many to many relation
        return $this->belongsToMany(Medicine::class,'medicine_pharmacies');
    }


}
