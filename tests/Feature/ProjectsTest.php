<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\ProjectFactory;
use App\Models\Project;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_project_requires_a_title()
    {
        $attributes = [
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $attributes = [
            'title' => $this->faker->sentence,
        ];

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();
        
        $project = ProjectFactory::new()->create();

        $this->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description);
    }

    public function test_no_projects_in_database()
    {
        Project::truncate();

        $this->assertDatabaseCount('projects', 0);

        $this->get('/projects')->assertSee('No projects in database');
    }

    public function test_a_project_requies_an_owner() {
        $attributes = ProjectFactory::new()->raw(['owner_id' => null]);

        $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');
    }
}
