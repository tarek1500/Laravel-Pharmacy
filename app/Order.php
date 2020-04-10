<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

         return $this->belongsToMany(Medicine::class,'medicine_orders')->withPivot(['price','quantity'])->withTimestamps();
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

    
    public function getCompleteMedicinesAttribute(){
        $medicines=[];
        foreach($this->medicines as $medicine){
            $medicine["quantity"]=$medicine->pivot->quantity;
            $medicine["price"] = $medicine->pivot->price;
            $medicines[]=$medicine;
        }
        return $medicines;
    }

    public function getPharmacyAttribute()
    {
        $pharmacy= Pharmacy::find($this->pharamcy_id);   
        if($pharmacy)
            $pharmacy['address']=$pharmacy->area->name.", ".$pharmacy->area->address;
        return $pharmacy;
    }

    public function setPrescriptionsAttribute($files)
    {   
        $this->deleteOldPrescriptions();
        foreach($files as $file){ 
            $path = $file->store('public/images/prescriptions');
            Prescription::create([
                'image'=>$path,
                'order_id'=>$this->id
            ]);
       }
       $this->save();
    }

    private function deleteOldPrescriptions(){
        $prescriptions = Prescription::where('order_id',$this->id)->get();
    
        if($prescriptions)
            foreach($prescriptions as $pres){
                Storage::delete($pres->image);
                $pres->delete();
            }
    }

    public function getCompleteOrderAttribute()
    {
        $order['id']=$this->id;
        $order['status']=Order::$statuses[$this->status_id];
        $order['doctor_name']=$this->doctor?$this->doctor->name : 'none';
        $order['orderd_user']=$this->user->name;
        $order['is_insured']= $this->is_insured ? 'yes':'no';
        $order['created_at']=$this->created_at->format('d M Y');
        $order['updated_at']=$this->updated_at->format('d M Y');
        $order['delivering_address']='flat:'.$this->address->flat_number .',' 
                                    .'floor:'.$this->address->floor_number .',' 
                                    . $this->address->building_number
                                    . $this->address->street_name . ' st,'
                                    . $this->address->area->name .','   
                                    . $this->address->area->address;
        $order['total_price']=$this->total_price;
        $order['prescriptions']=$this->prescriptions;
        if(Auth::guard('admin')->check())
        {
            $order['pharmacy']=$this->pharmacy?$this->pharmacy->name:'none';
            $order['creator_type']=$this->creator_type;

        }
        return $order;
    }

    public function getCompleteStatusAttribute()
    {
        return Order::$statuses[$this->status_id];
    }

    
}
