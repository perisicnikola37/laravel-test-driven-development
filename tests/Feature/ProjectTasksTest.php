<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\Helpers\TestSetupHelper;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_add_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    public function test_only_the_owner_of_a_project_may_add_tasks()
    {
        $project = TestSetupHelper::setUpProject($this);

        $this->post($project->path() . '/tasks', ['body' => 'Test task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    public function test_a_project_can_have_tasks()
    {
        $project = TestSetupHelper::setUpProjectWithTask($this);

        $this->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    public function test_a_task_requires_a_body()
    {
        $this->signIn();

        $project = Auth::user()->projects()->create(
            Project::factory()->raw()
        );

        $attributes = ['body' => ''];

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }

    public function test_a_task_can_be_updated()
    {
        $project = TestSetupHelper::setUpProjectWithTask($this);

        $this->patch($project->path() . '/tasks/' . $project->tasks->first()->id, [
            'body' => 'changed',
            'completed' => 1,
        ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => 1,
        ]);
    }

    public function test_only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $task = $project->addTask('Test task');

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'changed',
            'completed' => 1,
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'body' => 'changed',
            'completed' => 1,
        ]);
    }
}
