<?php

namespace App\Contracts\ServiceInterfaces;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthServiceInterface
{
    public function register(array $data): User;

    public function login(array $credentials): ?Authenticatable;

    public function logout(): void;
}
