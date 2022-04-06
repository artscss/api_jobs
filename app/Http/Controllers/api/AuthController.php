<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Job;
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
    // logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json("Successfully logged out");
    }
    // dashboard
    public function index()
    {
        $data = Job::all();
        if(count($data) > 0){
            return response()->json(["data" => $data, "message" => "success", "status" => 200], 200);
        }else{
            return response()->json(["message" => "not found any jobs", "status" => 400], 400);
        }
    }
    // edit profile
    public function edit_profile(Request $request)
    {
        if(User::find(Auth::user()->id))
        {
            $validator = Validator::make($request->all(), [
                "name" => ["string", "min:3", "max:20", "regex:/^[a-zA-Z]+$/"],
                "email" => ["email", "unique:users,email," . Auth::user()->id],
                "password" => ["max:80"],
                "address" => ["nullable", "string", "max:100"],
                "phone" => ["nullable", "regex:/^(010|011|012|014|015)[0-9]{8}$/"],
                "age" => ["nullable", "numeric", "min:10", "max:100"],
                "image" => ["nullable", "image", "mimes:png,jpg"],
                "cv" => ["nullable", "mimes:pdf", "max:10000"],
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $data = User::find(Auth::user()->id);
            if(collect($request->name)->isEmpty()) // name
            {
                $data->name = $data->name;
            }else{
                $data->name = $request->name;
            }
            if(collect($request->email)->isEmpty()) // email
            {
                $data->email = $data->email;
            }else{
                $data->email = $request->email;
            }
            if(collect($request->password)->isEmpty()) // password
            {
                $data->password = $data->password;
            }else{
                $data->password = bcrypt($request->password);
            }
            if(collect($request->address)->isEmpty()) // address
            {
                $data->address = $data->address;
            }else{
                $data->address = $request->address;
            }
            if(collect($request->phone)->isEmpty()) // phone
            {
                $data->phone = $data->phone;
            }else{
                $data->phone = $request->phone;
            }
            if(collect($request->age)->isEmpty()) // age
            {
                $data->age = $data->age;
            }else{
                $data->age = $request->age;
            }
        if($request->hasFile("image")){
            if($data->image !== "avatar.png")
            {
                unlink(public_path("images/") . $data->image);
            }
            $image = $request->file("image");
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . "." . $extension;
            $image->move(public_path("images/"), $image_name);
            $data->image = $image_name;
            }

        if($request->hasFile("cv")){
            if($data->cv)
            {
                unlink(public_path("upload/") . $data->cv);
            }
            $cv = $request->file("cv");
            $extension = $cv->getClientOriginalExtension();
            $cv_name = uniqid() . "." . $extension;
            $cv->move(public_path("upload/"), $cv_name);
            $data->cv = $cv_name;
            }
            $data->save();
            return response()->json(["data" => $data, "message" => "success", "status" => 200], 200);
        }
        return response()->json(["message" => "error", "status" => 400], 400);
    }

}
