<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\User;

class RegisterController extends Controller
{
    /**
     * @api {POST} /api/register
     * Register a new user after request validations
     * 
     * @return json
     */
    public function register(RegisterRequest $request, User $user)
    {
        return new RegisterResource(
            $user->userRegister($request)
        );
    }
}
