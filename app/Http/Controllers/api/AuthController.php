<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\AuthInterface;
use App\Http\Requests\api\LoginAuthRequest;
use App\Http\Requests\api\ProfileAuthRequest;
use App\Http\Requests\api\RegisterAuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $AuthInterface;
    public function __construct(AuthInterface $authInterface)
    {
        $this->AuthInterface = $authInterface;
    }
    // register
    public function register(RegisterAuthRequest $request)
    {
        return $this->AuthInterface->register($request);
    }
    // login
    public function login(LoginAuthRequest $request)
    {
        return $this->AuthInterface->login($request);
    }
    // logout
    public function logout(Request $request)
    {
        return $this->AuthInterface->logout($request);
    }
    // dashboard
    public function index()
    {
        return $this->AuthInterface->index();
    }
    // edit profile
    public function edit_profile(ProfileAuthRequest $request)
    {
        return $this->AuthInterface->edit_profile($request);
    }

}
