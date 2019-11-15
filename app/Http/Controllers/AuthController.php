<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\User;

class AuthController extends Controller
{
    /**
     * @api {POST} /api/register
     * Register a new user after request validations
     * 
     * @return json
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "name"         => $request->name,
            "username"     => $request->username,
            "email"        => $request->email,
            "password"     => Hash::make($request->password),
            "api_token"    => generateToken(),
            "api_token_expiry" => generateTokenExpiry()
        ]);

        return new RegisterResource($user);
    }

    public function login()
    {
        
    }

    public function logout()
    {
        
    }
}
