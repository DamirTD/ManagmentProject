<?php

namespace App\Repositories;

use App\Models\User;
use App\RepositoryInterfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data): array
    {
        $user = User::create($data);
        return $user->toArray();
    }

//    TODO
//    public function updateUser(int $userId, array $data): void
//    {
//        $user = User::findOrFail($userId);
//        $user->update($data);
//    }
//
//    public function deleteUser(int $userId): void
//    {
//        $user = User::findOrFail($userId);
//        $user->delete();
//    }
}
