<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'gender' => ['required', 'in:m,f'],
			'date_of_birth' => ['date'],
			'avatar_img' => ['image', 'max:5120', 'mimes:jpeg,bmp,png'],
			'mobile_number' => ['required', 'size:11'],
			'national_id' => ['required', 'size:14', 'unique:users,national_id'],
			'device_name' => ['required']
		];
    }
}