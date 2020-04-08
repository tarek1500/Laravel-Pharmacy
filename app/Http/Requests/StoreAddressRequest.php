<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'street_name'=>'required',
            'building_number'=>'required',
            'floor_number'=>'required',
            'flat_number'=>'required',
            'is_main'=>'required',
            'area_id'=>'required',
            'user_id'
        ];
    }
}
