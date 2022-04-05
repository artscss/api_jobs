<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // register
    public function register()
    {
        return view("auth.register");
    }
    // register
    public function requestregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "regex:/^[a-zA-Z]+$/u", "min:3", "max:50"],
            "email" => ["required", "email", "unique:users,email," . Auth::id()],
            "password" => ["required", "min:5", "max:20"],
            "password_confirmation" => ["required", "same:password"],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        Auth::login($data);
        return redirect("/dashboard");
    }
}
