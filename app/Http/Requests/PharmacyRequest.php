<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
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
            'name'=> 'required|min:6',
            'email'=> 'required|unique:pharmacies|email_address',
            'password'=> 'required|min:6',
            'national_id'=> 'required|unique:pharmacies|numeric',
            'avatar_image'=> 'file|mimes:jpeg,jpg',
            'priority'=> 'required',
            'area_id'=> 'required'
        ];
    }
}
