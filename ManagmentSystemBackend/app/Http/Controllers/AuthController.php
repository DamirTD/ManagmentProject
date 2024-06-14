<?php

namespace App\Http\Controllers;

use App\Enums\ErrorCodes;
use App\Enums\HttpStatusCodes;
use App\RepositoryInterfaces\UserRepositoryInterface;
use App\Requests\LoginRequest;
use App\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Документация API",
 *     version="1.0.0"
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Локальный сервер"
 * )
 * @OA\Tag(
 *     name="Аутентификация",
 *     description="Эндпоинты для аутентификации пользователей"
 * )
 */
class AuthController extends Controller
{
    protected AuthService $authService;
    protected UserRepositoryInterface $userRepository;

    public function __construct(AuthService $authService, UserRepositoryInterface $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Аутентификация"},
     *     summary="Регистрация нового пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="Иван Иванов",
     *                 description="Имя пользователя"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="ivan.ivanov@example.com",
     *                 description="Электронная почта пользователя"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 example="password123",
     *                 description="Пароль пользователя"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Пользователь успешно зарегистрирован",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Пользователь успешно зарегистрирован"),
     *             @OA\Property(property="user", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Ошибка валидации")
     *         )
     *     )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->only('name', 'email', 'password');
        $user = $this->userRepository->createUser($data);

        return response()->json([
            'message' => 'Пользователь успешно зарегистрирован',
            'user' => $user
        ], HttpStatusCodes::CREATED);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Аутентификация"},
     *     summary="Вход по учетным данным",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 example="ivan.ivanov@example.com",
     *                 description="Электронная почта пользователя"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 example="password123",
     *                 description="Пароль пользователя"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный вход",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Успешный вход"),
     *             @OA\Property(property="user", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неверные учетные данные",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Неверные учетные данные")
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = $this->authService->login($credentials);

        if ($user) {
            return response()->json(['message' => 'Успешный вход', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Неверные учетные данные'], ErrorCodes::UNAUTHORIZED);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Аутентификация"},
     *     summary="Выход аутентифицированного пользователя",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный выход",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Успешный выход")
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'Успешный выход']);
    }
}
