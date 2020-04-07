<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
   
        return [
            'id'=>$this->id,
            'ordered_at'=>$this->created_at,
            'status'=>$this->status,
            'assigned_pharmacy'=>new PharmacyResource($this->pharmacy),
            'medicines'=>MedicineResource::Collection($this->complete_medicines) ,
            'total_price'=>$this->total_price,
        ];
    }
}
