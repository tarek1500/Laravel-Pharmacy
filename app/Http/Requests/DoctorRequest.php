<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'password'=> 'required|min:6',
            'email' => [
                'required','email',
                Rule::unique('doctors')->ignore($this->doctor)
            ],
            'avatar_image'=> 'file|mimes:jpeg,jpg',
            'national_id' => [
                'required','numeric',
                Rule::unique('doctors')->ignore($this->doctor)
            ],
            'priority'=> 'required',
            'area_id'=> 'required'
        ];
    }
}
