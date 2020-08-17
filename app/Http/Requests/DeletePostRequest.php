<?php

namespace App\Http\Requests;

use App\Post;
use App\Rules\CheckPostAuthor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeletePostRequest extends FormRequest
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
        $user = $this->user();
        return [
            'post' => 'required',
            'post_id' => [
                'required', 
                new CheckPostAuthor(
                    $this->post ? $this->post->user_id : null,
                    $user->id
                )
            ]
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->post = Post::find($this->post_id);
        
        $this->merge([
            'post' => $this->post
        ]);
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
