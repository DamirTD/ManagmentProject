<?php

namespace App\Contracts\RepositoryInterfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(array $data): User;
}
