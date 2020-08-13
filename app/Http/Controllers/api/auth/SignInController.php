<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\User;

class SignInController extends Controller
{
    /**
     * @api {POST} /api/login
     * Login user account after request validations
     * 
     * @return json
     */
    public function signIn(LoginRequest $request, User $user)
    {
        return new LoginResource(
            $user->userSignIn($request)
        );
    }
}
