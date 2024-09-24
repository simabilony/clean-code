<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function create(array $userData): User
    {
        $user = User::create($userData);
        $user->roles()->sync($userData['roles']);

        return $user;
    }
}
