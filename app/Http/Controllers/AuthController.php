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
            "name" => ["required", "regex:/^[a-zA-Z]+$/", "min:3", "max:50"],
            "email" => ["required", "email", "unique:users,email," . Auth::id()],
            "password" => ["required", "min:5", "max:20"],
            "password_confirmation" => ["required", "same:password"],
        ]);
        if ($validator->fails()) {
            return redirect()->route("auth.register")
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
    // logout
    public function logout()
    {
        Auth::logout();
        return redirect("/logout")->with("success", "successful logout");
    }
    // edit_profile
    public function edit_profile()
    {
        $user = User::find(Auth::user()->id);
        return view("auth.editprofile", compact("user"));
    }
    public function requestprofile(Request $request)
    {
        $request->validate([
            "name" => ["string", "min:3", "max:20", "regex:/^[a-zA-Z]+$/"],
            "email" => ["email", "unique:users,email," . Auth::user()->id],
            "password" => ["max:80"],
            "address" => ["nullable", "string", "max:100"],
            "phone" => ["nullable", "regex:/^(010|011|012|014|015)[0-9]{8}$/"],
            "age" => ["nullable", "numeric", "min:10", "max:100"],
            "image" => ["nullable", "image", "mimes:png,jpg"],
            "cv" => ["nullable", "mimes:pdf", "max:10000"],
        ]);
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        if(collect($request->password)->isEmpty()) // null
        {
            $data->password = $data->password;
        }else{
            $data->password = bcrypt($request->password);
        }
        if(collect($request->address)->isEmpty()) // null
        {
            $data->address = $data->address;
        }else{
            $data->address = $request->address;
        }
        if(collect($request->phone)->isEmpty()) // null
        {
            $data->phone = $data->phone;
        }else{
            $data->phone = $request->phone;
        }
        if(collect($request->age)->isEmpty()) // null
        {
            $data->age = $data->age;
        }else{
            $data->age  = $request->age;
        }

        if($request->hasFile("image")){
            if($data->image !== "avatar.png"){
                unlink(public_path("images/") . $data->image);
            }
            $image = $request->file("image");
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . "." . $extension;
            $image->move(public_path("images/"), $image_name);
            $data->image = $image_name;
        }

        if($request->hasFile("cv")){
            if($data->cv){
                unlink(public_path("upload/") . $data->cv);
            }
            $cv = $request->file("cv");
            $extension = $cv->getClientOriginalExtension();
            $cv_name = uniqid() . "." . $extension;
            $cv->move(public_path("upload/"), $cv_name);
            $data->cv = $cv_name;
        }
        
        $data->save();
        return redirect()->route("edit.profile")->with("success", "profile updated successfully");
    }
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view("auth.profile", compact("user"));
    }
}
