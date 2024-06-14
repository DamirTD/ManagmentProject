<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\HttpStatusCodes;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testShowTasks()
    {
        $user = User::factory()->create();
        Task::factory()->count(3)->create(['assigned_to' => $user->id]);

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(HttpStatusCodes::OK->value)
            ->assertJsonCount(3);
    }

    public function testCreateTasks()
    {
        $user = User::factory()->create();
        $taskData = [
            'name' => 'New Task',
            'description' => 'Task description',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(7)->toDateString(),
            'assigned_to' => $user->id,
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(HttpStatusCodes::CREATED->value)
            ->assertJsonFragment($taskData);

        $this->assertDatabaseHas('tasks', $taskData);
    }

    public function testShowOneTask()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['assigned_to' => $user->id]);

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(HttpStatusCodes::OK->value)
            ->assertJsonFragment([
                'id' => $task->id,
                'name' => $task->name,
                'description' => $task->description,
            ]);
    }

    public function testUpdateTasks()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['assigned_to' => $user->id]);

        $updatedData = [
            'name' => 'Updated Task',
            'description' => 'Updated description',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays(10)->toDateString(),
            'assigned_to' => $user->id,
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updatedData);

        $response->assertStatus(HttpStatusCodes::OK->value)
            ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('tasks', $updatedData);
    }

    public function testDestroyTask()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(HttpStatusCodes::NO_CONTENT->value);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
