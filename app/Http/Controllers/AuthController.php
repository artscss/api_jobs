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
    // requestregister
    public function requestregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "regex:/^[a-zA-Z]+$/u", "min:3", "max:50"],
            "email" => ["required", "email", "unique:users,email," . Auth::id()],
            "password" => ["required", "min:5", "max:20"],
            "password_confirmation" => ["required", "same:password"],
        ]);
        if ($validator->fails()) {
            return redirect("/register")
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        Auth::login($data);
        return redirect("/dashboard")->with("success", "new account create");
    }
    // login
    public function login()
    {
        return view("auth.login");
    }
    // requestlogin
    public function requestlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", "email"],
            "password" => ["required", "min:5", "max:20"],
        ]);
        if ($validator->fails()) {
            return redirect("/login")
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        if(Auth::attempt($data)){
            return redirect("/dashboard");
        }
        return redirect("/login")->with("danger", "The data is wrong");
    }
}
