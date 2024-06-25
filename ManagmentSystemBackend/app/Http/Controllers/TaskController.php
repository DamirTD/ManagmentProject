<?php

namespace App\Http\Controllers;

use App\Contracts\RepositoryInterfaces\TaskRepositoryInterface;
use App\Requests\Task\StoreTaskRequest;
use App\Requests\Task\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Получить список тасков",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="Успешная операция",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Task"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskRepository->getAllTasks();
        return response()->json($tasks, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Создать новый таск",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreTaskRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Таск создан успешно",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->taskRepository->createTask($validated);
        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Список тасков по ID",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID таска для просмотра",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешная операция",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $task = $this->taskRepository->getTaskById($id);
        return response()->json($task, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Обновить существующий таск",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID таска для обновления",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateTaskRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     )
     * )
     */
    public function update(UpdateTaskRequest $request, $id): JsonResponse
    {
        $validated = $request->validated();
        $task = $this->taskRepository->updateTask($id, $validated);
        return response()->json($task, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Удалить таск",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID таска для удаления",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Таск удален успешно"
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        $result = $this->taskRepository->destroy($id);
        return response()->json(['message' => $result['message']], $result['status']);
    }
}
