<?php

namespace App\Http\Controllers;

use App\Core\Contracts\UserRepositoryInterface;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepositroy;
    public function __construct(UserRepositoryInterface  $userRepositroy)
    {
        $this->userRepositroy =  $userRepositroy;
    }

    /**
     * Register a newly created user in storage.
     */
    public function register(RegisterRequest $request)
    {
        //Create user and get his info
        $user = $this->userRepositroy->register($request->toDto());
        return response()->json(['data' => $user]);
    }

    /**
     * Login function.
     */
    public function login(LoginRequest $request)
    {
        //login user and get the token
        $token = $this->userRepositroy->login($request->toDto());
        return response()->json(['token' => $token]);
    }

    /**
     * Logout function.
     */
    public function logout(Request $request)
    {
        //logout user
        $this->userRepositroy->logout($request);
        return response()->json([
            'success' => 'You have logged out successfully '
        ]);
    }
}
