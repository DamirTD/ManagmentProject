<?php

namespace App\Contracts\Repositories;

use App\Contracts\RepositoryInterfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data): User
    {
        return User::create($data);
    }
}
