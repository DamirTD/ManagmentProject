<?php

namespace App\Contracts\Services;

use App\Contracts\ServiceInterfaces\TaskServiceInterface;
use App\Models\Task;

class TaskService implements TaskServiceInterface
{
    public function getTaskByIdOrFail(int $id): Task
    {
        $task = new Task();
        return $task->findOrFail($id);
    }
}
