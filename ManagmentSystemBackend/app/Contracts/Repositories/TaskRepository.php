<?php

namespace App\Contracts\Repositories;

use App\Contracts\RepositoryInterfaces\TaskRepositoryInterface;
use App\Contracts\ServiceInterfaces\TaskServiceInterface;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskRepository implements TaskRepositoryInterface
{
    protected TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getAllTasks(): array
    {
        return Task::with('user')->get()->toArray();
    }

    public function getTaskById(int $id): Task
    {
        return $this->taskService->getTaskByIdOrFail($id);
    }

    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(int $id, array $data): Task
    {
        $task = $this->taskService->getTaskByIdOrFail($id);
        $task->update($data);

        return $task;
    }

    public function destroy(int $id): array
    {
        $task = $this->taskService->getTaskByIdOrFail($id);
        $task->delete();

        return [
            'status'  => ResponseAlias::HTTP_NO_CONTENT,
            'message' => 'Task deleted successfully'
        ];
    }
}
