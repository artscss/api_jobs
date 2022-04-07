<?php

namespace App\Http\Interfaces;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\ProfileAuthRequest;
use App\Http\Requests\RegisterAuthRequest;

interface AuthInterface {
    public function register();
    public function requestregister(RegisterAuthRequest $request);
    public function login();
    public function requestlogin(LoginAuthRequest $request);
    public function logout();
    public function edit_profile();
    public function requestprofile(ProfileAuthRequest $request);
    public function profile($id);
}