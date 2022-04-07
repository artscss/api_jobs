<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfileAuthRequest extends FormRequest
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
            //
            "name" => ["string", "min:3", "max:20", "regex:/^[a-zA-Z]+$/"],
            "email" => ["email", "unique:users,email," . Auth::user()->id],
            "password" => ["max:80"],
            "address" => ["nullable", "string", "max:100"],
            "phone" => ["nullable", "regex:/^(010|011|012|014|015)[0-9]{8}$/"],
            "age" => ["nullable", "numeric", "min:10", "max:100"],
            "image" => ["nullable", "image", "mimes:png,jpg"],
            "cv" => ["nullable", "mimes:pdf", "max:10000"],
        ];
    }
    public function failedValidation( $validator)
    {
        $response = response()->json($validator->errors(), 400);
    
        throw (new ValidationException($validator, $response))->status(400);
    }
}
