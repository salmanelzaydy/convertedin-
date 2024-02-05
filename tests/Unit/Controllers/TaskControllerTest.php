<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user; // Define the $user property

    protected function setUp(): void
    {
        parent::setUp();

        // Create or use an existing user for testing
        $this->user = User::factory()->create();
    }

    public function test_it_can_delete_a_task()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->delete("/tasks/{$task->id}");

        $response->assertStatus(302); // Check if the task deletion was successful (redirect status code)
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_it_can_show_task_details()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->get("/tasks/{$task->id}");

        $response->assertStatus(200); // Check if the task details page is accessible
        $response->assertSee($task->title); // Check if the task title is displayed on the page
    }

    public function test_it_redirects_unauthorized_users_to_login()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(302); // Check if the unauthorized user is redirected to login
        $response->assertRedirect('/login');
    }

    public function test_it_cannot_access_statistics_page_for_guests()
    {
        $response = $this->get('/tasks/statistics');

        $response->assertStatus(302); // Check if the guest is redirected to login
        $response->assertRedirect('/login');
    }

    public function test_it_cannot_delete_task_without_authentication()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertStatus(302); // Check if the unauthorized attempt to delete is redirected
        $this->assertDatabaseHas('tasks', ['id' => $task->id]); // Ensure the task still exists
    }

    public function test_it_cannot_show_task_details_for_guests()
    {
        $task = Task::factory()->create(['assigned_to_id' => $this->user->id]);

        $response = $this->get("/tasks/{$task->id}");

        $response->assertStatus(302); // Check if the guest is redirected to login
        $response->assertRedirect('/login');
    }
}

