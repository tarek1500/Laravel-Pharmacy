<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
        'street_name'=>'required',
        'building_number'=> 'required|numeric',
        'floor_number'=> 'required|numeric',
        'flat_number'=> 'required|numeric',
        'is_main'=> 'required',
        'area_id'=> 'required',
        'user_id'=> 'required',
        ];
    }
}
