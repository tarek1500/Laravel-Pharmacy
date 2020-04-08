<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'email' => [
                'required','email',
                Rule::unique('pharmacies')->ignore($this->pharmacy)
            ],
           
            'password'=> 'required|min:6',
            'national_id' => [
                'required','numeric',
                Rule::unique('pharmacies')->ignore($this->pharmacy)
            ],
            'avatar_image'=> 'sometimes|file|mimes:jpeg,jpg',
            'priority'=> 'required',
            'area_id'=> 'required'
        ];
    }
}
