<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\ProfileAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    public function register()
    {
        return view("auth.register");
    }
    public function requestregister(RegisterAuthRequest $request)
    {
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        Auth::login($data);
        return redirect("/dashboard")->with("success", "new account create");
    }
    public function login()
    {
        return view("auth.login");
    }
    public function requestlogin(LoginAuthRequest $request)
    {
        $data = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        if(Auth::attempt($data)){
            return redirect("/dashboard");
        }
        return redirect("/login")->with("danger", "The data is wrong");
    }
    public function logout()
    {
        Auth::logout();
        return redirect("/logout")->with("success", "successful logout");
    }
    public function edit_profile()
    {
        $user = User::find(Auth::user()->id);
        return view("auth.editprofile", compact("user"));
    }
    public function requestprofile(ProfileAuthRequest $request)
    {
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