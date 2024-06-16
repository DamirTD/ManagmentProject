<?php

namespace App\Contracts\RepositoryInterfaces;

interface TaskRepositoryInterface
{
    public function getAllTasks(): array;

    public function getTaskById(int $id);

    public function createTask(array $data);

    public function updateTask(int $id, array $data);

    public function destroy(int $id): array;
}
