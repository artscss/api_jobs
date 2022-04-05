<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "regex:/^[a-zA-Z]a+/", "min:3", "max:50"],
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
        $token = $data->createToken("token_name")->plainTextToken;
        return response()->json(["data" => $data, "token" => $token, "status" => 200], 200);
    }
    // login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", "email"],
            "password" => ["required", "min:5", "max:20"],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $data = User::where("email", $request->email)->first();
        if (!$data || !Hash::check($request->password, $data->password)) {
            throw ValidationException::withMessages([
                "email" => ["The provided credentials are incorrect."],
            ]);
        }
        $token = $data->createToken("token_name")->plainTextToken;
        return response()->json(["data" => $data, "token" => $token, "status" => 200], 200);
    }
}
