<?php

namespace App\Http\Interfaces\Api;

use App\Http\Requests\api\LoginAuthRequest;
use App\Http\Requests\api\ProfileAuthRequest;
use App\Http\Requests\api\RegisterAuthRequest;

interface AuthInterface {
    public function register(RegisterAuthRequest $request);
    public function login(LoginAuthRequest $request);
    public function logout($request);
    public function index();
    public function edit_profile(ProfileAuthRequest $request);
}