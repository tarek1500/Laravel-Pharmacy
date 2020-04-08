<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ApiOrderStoreRequest extends FormRequest
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
        'delivering_address_id'=> ['required','numeric',Rule::exists('addresses','id')->where(function($query){
            $query->where('user_id',Auth::id());
         })],
         'prescriptions.*' =>'mimes:jpeg,bmp,png',
        ];
    }

    public function messages()
    {
        return [
           
            'delivering_address_id.exists'  => 'this address is not one of your addresses',
        ];
    }
}
