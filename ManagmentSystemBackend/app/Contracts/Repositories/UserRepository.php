<?php

namespace App\Contracts\Repositories;

use App\Contracts\RepositoryInterfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data): User
    {
        $user = new User();
        return $user->create($data);
    }
}
