<?php

namespace App\Contracts\Services;

use App\Contracts\RepositoryInterfaces\UserRepositoryInterface;
use App\Contracts\ServiceInterfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        $userData = [
            'first_name'   => $data['firstName'],
            'last_name'    => $data['lastName'],
            'email'        => $data['email'],
            'phone_number' => $data['phoneNumber'],
            'age'          => $data['age'],
            'gender'       => $data['gender'],
            'password'     => $data['password'],
            'name'         => $data['firstName'] . ' ' . $data['lastName'],
        ];

        return $this->userRepository->createUser($userData);
    }

    public function login(array $credentials): ?Authenticatable
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        return null;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
