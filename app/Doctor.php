<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'avatar_image',
        'is_baned',
        'pharmacy_id',
    ];
    protected $hidden = [
        'password',
    ];
    
    //function pharmacy represent one to many relation between pharmacy and doctors
    public function pharmacy()
    {   
        return $this->belongsTo('App\Pharmacy');
    }
}
