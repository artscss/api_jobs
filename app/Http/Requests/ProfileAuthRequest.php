<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileAuthRequest extends FormRequest
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
}
