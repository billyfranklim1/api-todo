<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_todos()
    {
        Todo::factory()->count(5)->create();

        $response = $this->getJson('/api/todos');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'description',
                'completed',
            ]
        ]);



    }

    public function test_can_create_todo()
    {
        $todoData = [
            'title' => 'New Todo Title',
            'description' => 'New Todo Description',
            'completed' => false
        ];

        $response = $this->postJson('/api/todos', $todoData);

        $response->assertStatus(201);
        $response->assertJsonFragment($todoData);
    }

    public function test_cannot_create_todo_without_title()
    {
        $todoData = [];

        $response = $this->postJson('/api/todos', $todoData);

        $response->assertStatus(422);

        $response->assertJsonFragment([
            'message' => 'Validation failed',
            'errors' => [
                'title' => [trans('validation.required', ['attribute' => 'title'])],
                'description' => [trans('validation.required', ['attribute' => 'description'])]
            ]
        ]);
    }

    public function test_can_retrieve_single_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->getJson("/api/todos/{$todo->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $todo->id,
            'title' => $todo->title,
            'description' => $todo->description,
            'completed' => $todo->completed,
        ]);
    }

    public function test_can_update_todo()
    {
        $todo = Todo::factory()->create();

        $updateData = [
            'title' => 'Updated Todo Title',
            'description' => 'Updated Todo Description',
            'completed' => true,
        ];

        $response = $this->putJson("/api/todos/{$todo->id}", $updateData);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $todo->id,
            'title' => $updateData['title'],
            'description' => $updateData['description'],
            'completed' => $updateData['completed'],
        ]);
    }

    public function test_can_delete_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->deleteJson("/api/todos/{$todo->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }

    public function test_can_complete_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->putJson("/api/todos/{$todo->id}/complete");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $todo->id,
            'completed' => true,
        ]);
    }

    public function test_can_incomplete_todo()
    {
        $todo = Todo::factory()->create(['completed' => 1]);

        $response = $this->putJson("/api/todos/{$todo->id}/incomplete");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $todo->id,
            'completed' => false,
        ]);
    }

}

