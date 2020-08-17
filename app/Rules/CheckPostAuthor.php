<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPostAuthor implements Rule
{
    protected $userId;
    protected $postUserId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userId, $postUserId)
    {
        $this->userId = $userId;
        $this->postUserId = $postUserId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->userId == $this->postUserId)
            return true;
        
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
