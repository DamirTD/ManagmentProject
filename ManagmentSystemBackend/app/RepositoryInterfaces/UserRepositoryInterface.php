<?php

namespace App\RepositoryInterfaces;

interface UserRepositoryInterface
{
    public function createUser(array $data): array;

//    TODO
//    public function updateUser(int $userId, array $data): void;
//
//    public function deleteUser(int $userId): void;
}
