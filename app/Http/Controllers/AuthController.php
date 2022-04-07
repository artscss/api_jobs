<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\ProfileAuthRequest;
use App\Http\Requests\RegisterAuthRequest;

class AuthController extends Controller
{
    protected $AuthInterface;
    public function __construct(AuthInterface $authInterface)
    {
        $this->AuthInterface = $authInterface;
    }
    // register
    public function register()
    {
        return $this->AuthInterface->register();
    }
    // requestregister
    public function requestregister(RegisterAuthRequest $request)
    {
        return $this->AuthInterface->requestregister($request);
    }
    // login
    public function login()
    {
        return $this->AuthInterface->login();
    }
    // requestlogin
    public function requestlogin(LoginAuthRequest $request)
    {
        return $this->AuthInterface->requestlogin($request);
    }
    // logout
    public function logout()
    {
        return $this->AuthInterface->logout();
    }
    // edit_profile
    public function edit_profile()
    {
        return $this->AuthInterface->edit_profile();
    }
    public function requestprofile(ProfileAuthRequest $request)
    {
        return $this->AuthInterface->requestprofile($request);
    }
        // show_profile
    public function profile($id)
    {
        return $this->AuthInterface->profile($id);
    }
}
