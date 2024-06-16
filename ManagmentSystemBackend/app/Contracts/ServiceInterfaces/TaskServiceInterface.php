<?php

namespace App\Contracts\ServiceInterfaces;

use App\Models\Task;

interface TaskServiceInterface
{
    public function getTaskByIdOrFail(int $id): Task;
}
