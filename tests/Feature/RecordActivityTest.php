<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\TestSetupHelper;
use Tests\TestCase;

class RecordActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_project()
    {
        $project = Project::factory()->create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('Created', $project->activity->first()->description);
    }

    public function test_updating_a_project()
    {
        $project = Project::factory()->create();
        $project->update(['title' => 'Updated']);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('Updated', $project->activity->last()->description);
    }

    public function test_creating_a_new_task()
    {
        $project = TestSetupHelper::setUpProjectWithTask($this);

        $this->assertCount(2, $project->activity);
        $this->assertEquals('Created', $project->activity->last()->description);
    }

    public function test_completing_a_new_task()
    {
        $project = TestSetupHelper::setUpProjectWithTask($this);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'foobar',
            'completed' => true,
        ]);

        $this->assertCount(4, $project->activity);
        $this->assertEquals('Updated', $project->activity->last()->description);
    }
}
