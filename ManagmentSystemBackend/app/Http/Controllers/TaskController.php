<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatusCodes;
use App\Models\Task;
use App\Requests\Task\StoreTaskRequest;
use App\Requests\Task\UpdateTaskRequest;
use HttpStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
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
        $tasks = Task::with('user')->get();
        return response()->json($tasks, HttpStatusCodes::OK->value);
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

        $task = Task::create($validated);

        return response()->json($task, HttpStatusCodes::CREATED->value);
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
        $task = Task::with('user')->findOrFail($id);
        return response()->json($task, HttpStatusCodes::OK->value);
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
        $task = Task::findOrFail($id);

        $validated = $request->validated();

        $task->update($validated);

        return response()->json($task, HttpStatusCodes::OK->value);
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
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, HttpStatusCodes::NO_CONTENT->value);
    }
}
