<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
        return [
            'status_id' => ['required',
                function ($attribute, $value, $fail) {
                    if((Auth::guard('admin')->check() && !$value==0 ) )
                    {
                        $fail(' order status must be new');
                    }
                    else if((!Auth::guard('admin')->check() && ! in_array($value ,['5','4','3'])  ) )
                    {
                        $fail(' order status must be deliverd , confirmed or canceled ');
                    }
                }
            ] ,
            'order_user_id'=>['required','exists:App\User,id',
                function ($attribute, $value, $fail) {
                    if($user=User::find($value))
                    {
                        if(!$user->addresses()->where('is_main', '1')->first())
                        $fail(' this user does not have main address');
                    }
                }
            ],
            'med_name'=>'required',
            'med_name.*'=>'required',
            'med_type'=>'required',
            'med_type.*'=>'required',
            'med_price'=>'required',
            'med_price.*'=>['required','Numeric'],
            'med_quantity'=>'required',
            'med_quantity.*'=>['required','Numeric'],
        ];
    }

    public function messages()
    {
        return [
           
            'status_id.required'  => 'order must have status',
            'order_user_id.required'  => 'order must have orderd user',
            'order_user_id.exists'  => 'this orderd user is not a valid user',
            'med_name.required'  => 'medicines names is required',
            'med_name.*.required'  => 'medicine names can not be null',
            'med_type.required'  => 'medicines types is required',
            'med_type.*.required'  => 'medicine types can not be null',
            'med_price.required'  => 'medicines prices is required',
            'med_price.*.required'  => 'medicine prices can not be null',
            'med_price.*.Numeric'  => 'medicine prices must be number',
            'med_quantity.required'  => 'medicines quantity is required',
            'med_quantity.*.required'  => 'medicine quantity can not be null',
            'med_quantity.*.Numeric'  => 'medicine quantity must be number',

        ];
    }
}
