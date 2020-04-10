<?php

namespace App\Http\Requests;

use App\Order;
use App\Rules\MedNameType;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->order_status_id =Order::find($this->order)->status_id;
        $this->MedNameType = new MedNameType;
        return [
            'status_id' => ['required',
               function ($attribute, $value, $fail) {
                $validation_array=[];
                foreach(Order::$statuses as $key => $status)
                {
                    if($key >=  $this->order_status_id=Order::find($this->order)->status_id)
                        $validation_array[]=$key; 
                }
                if($this->order_status_id==0 && $value==1)
                    $fail('can not change new to processing');
                else if(!in_array($value , $validation_array) )
                    $fail('not valid status');
                
            }],
            'med_name'=>Rule::requiredIf( $this->order_status_id <2),
            'med_name.*'=>[Rule::requiredIf( $this->order_status_id<2),$this->MedNameType],
            'med_type'=>Rule::requiredIf( $this->order_status_id <2),
            'med_type.*'=>[Rule::requiredIf( $this->order_status_id <2),$this->MedNameType],
            'med_price'=>Rule::requiredIf( $this->order_status_id <2),
            'med_price.*'=>[Rule::requiredIf( $this->order_status_id <2),
            function ($attribute, $value, $fail) {
                if( $this->order_status_id <2 && !is_numeric($value))
                    $fail('medicine prices must be number');
            }],
            'med_quantity'=>Rule::requiredIf( $this->order_status_id <2),
            'med_quantity.*'=>[Rule::requiredIf( $this->order_status_id <2),
            function ($attribute, $value, $fail) {
                if( $this->order_status_id <2 && !is_numeric($value))
                    $fail('medicine quantity must be number');
            }],
        ];
    }

    public function messages()
    {
        return [
           
            'status_id.required'  => 'order must have status',
            'med_name.required'  => 'medicines names is required',
            'med_name.*.required'  => 'medicine names can not be null',
            'med_type.required'  => 'medicines types is required',
            'med_type.*.required'  => 'medicine types can not be null',
            'med_price.required'  => 'medicines prices is required',
            'med_price.*.required'  => 'medicine prices can not be null',
            'med_quantity.required'  => 'medicines quantity is required',
            'med_quantity.*.required'  => 'medicine quantity can not be null',

        ];
    }
}
