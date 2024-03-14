<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\Helpers\TestEndpointHelper;
use Tests\Helpers\TestSetupHelper;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    private function signInUser(): void
    {
        $this->signIn();
    }

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

        TestEndpointHelper::postTaskToProject($this, $project, 'Test task');
        TestEndpointHelper::getTaskInProject($this, $project, 'Test task');
    }

    public function test_a_task_requires_a_body()
    {
        $this->signInUser();

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
        $this->signInUser();
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

    public function test_a_task_can_be_marked_as_incomplete()
    {
        $project = TestSetupHelper::setUpProjectWithTask($this);

        $this->patch($project->path() . '/tasks/' . $project->tasks->first()->id, [
            'body' => 'changed',
            'completed' => 1,
        ]);

        $this->patch($project->path() . '/tasks/' . $project->tasks->first()->id, [
            'body' => 'changed',
            'completed' => 0,
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => 0,
        ]);
    }
}
