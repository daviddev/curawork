<?php

namespace App\Rules;

use App\Models\Connection;
use Illuminate\Contracts\Validation\Rule;

class ExistConnection implements Rule
{
    /**
     * @var int
     */
    private int $userFromId;

    /**
     * @var int
     */
    private int $userToId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $userFromId, int $userToId)
    {
        $this->userFromId = $userFromId;
        $this->userToId = $userToId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Connection::whereUserFromId($this->userFromId)->whereUserToId($this->userToId)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Connection with specified user_from_id and user_to_id} doesn't exists.";
    }
}
