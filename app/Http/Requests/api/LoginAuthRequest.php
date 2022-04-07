<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginAuthRequest extends FormRequest
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
            //
            "email" => ["required", "email"],
            "password" => ["required", "min:5", "max:20"],
        ];
    }
    public function failedValidation( $validator)
    {
        $response = response()->json($validator->errors(), 400);
    
        throw (new ValidationException($validator, $response))->status(400);
    }
}
