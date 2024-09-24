<?php
namespace App\Actions;

use App\Models\User;

class CreateUserAction
{
    public function execute(array $userData): User
    {
        $user = User::create($userData);
        $user->roles()->sync($userData['roles']);

        return $user;
    }
}
