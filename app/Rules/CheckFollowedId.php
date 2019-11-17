<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Follower;
use App\User;

class CheckFollowedId implements Rule
{
    public $userId;
    public $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
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
        if ( $this->userId == $value ) {
            $this->message = "You can't follow your's self.";
            return false;
        } else if ( Follower::alreadyFollowed($this->userId, $value) ) {
            $this->message = "You already follwed this user.";
            return false;
        } else if ( !User::find($value) ) {
            $this->message = "User don't exists";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
