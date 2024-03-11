<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_add_tasks_to_projects() {
        $project = Project::factory()->create();
    
        $this->post($project->path().'/tasks')->assertRedirect('login');
    }

    public function test_only_the_owner_of_a_project_may_add_tasks() {
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path().'/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function test_a_project_can_have_tasks()
    {
        $this->signIn();

        $project = Auth::user()->projects()->create(
            Project::factory()->raw()
        );

        $this->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    public function test_a_task_requires_a_body() {
        $this->signIn();
    
        $project = Auth::user()->projects()->create(
            Project::factory()->raw()
        );
    
        $attributes = ['body' => '']; 
    
        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
