<?php

namespace Tests\Feature;

use App\Enums\HttpStatusCodes;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterUser(): void
    {
        $response = $this->postJson('/api/register', [
            'name'     => 'John Doe',
            'email'    => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(HttpStatusCodes::CREATED->value)
            ->assertJsonStructure(['message', 'user' => ['id', 'name', 'email']]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com'
        ]);
    }

    public function testLoginUser(): void
    {
        User::factory()->create([
            'email'    => 'john.doe@example.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(HttpStatusCodes::OK->value)
            ->assertJsonStructure(['message', 'user' => ['id', 'name', 'email']]);
    }

    public function testLogoutUser(): void
    {
        $user = User::factory()->create([
            'email'    => 'john.doe@example.com',
            'password' => bcrypt('password')
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(HttpStatusCodes::OK->value)
            ->assertJson(['message' => 'Успешный выход']);
    }
}
