<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\User;
use App\Rules\UserPassword;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->user = User::where('username', $this->username)->first();
        $pass       = $this->user ? $this->user->password : null;

        return [
            'username' => 'required|exists:users',
            'password' => ['required', new UserPassword($pass)]
        ];
    }

    /**
     * Return error if validation fail
     *
     * @return Json
     */     
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
        response()->json(
            [
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 400
        ));
    }
}
