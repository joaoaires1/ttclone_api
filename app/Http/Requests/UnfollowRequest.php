<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UnfollowRequest extends FormRequest
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
        $this->user = $this->user();

        return [
            "followed_id" => "required"
        ];
    }

    /**
     * Return error if validation fail
     *
     * @return Json
     */     
    protected function failedValidation(ValidationValidator $validator) {
        throw new HttpResponseException(
        response()->json(
            [
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 400
        ));
    }
}
