<?php

namespace App\Http\Controllers;

use App\Enums\ErrorCodes;
use App\Enums\HttpStatusCodes;
use App\RepositoryInterfaces\UserRepositoryInterface;
use App\Requests\LoginRequest;
use App\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;
    protected UserRepositoryInterface $userRepository;

    public function __construct(AuthService $authService, UserRepositoryInterface $userRepository)
    {
        $this->authService    = $authService;
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->only('name', 'email', 'password');
        $user = $this->userRepository->createUser($data);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], HttpStatusCodes::CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = $this->authService->login($credentials);

        if ($user) {
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Invalid credentials'], ErrorCodes::UNAUTHORIZED);
        }
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
