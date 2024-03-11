<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Factories\ProjectFactory;
use App\Models\ {
    Project,
    User
};
use Illuminate\Support\Facades\Auth;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_create_projects()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(); 
        $this->actingAs($user); 

        $this->get('/projects/create')->assertStatus(200);

        $attributes = Project::factory()->raw(['owner_id' => $user->id]); 

        $this->post('/projects', array_merge($attributes));

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function test_a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = [
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = [
            'title' => $this->faker->sentence,
        ];

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_a_user_can_view_their_project()
    {
        $this->signIn();
        
        $project = ProjectFactory::new()->create(['owner_id' => Auth::id()]);

        $this->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description);
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();
        
        $project = ProjectFactory::new()->create();

        $this->get($project->path())->assertSee(403);
    }

    public function test_no_projects_in_database()
    {
        Project::truncate();

        $this->assertDatabaseCount('projects', 0);

        $this->get('/projects')->assertRedirect('login');
    }

    public function test_only_authenticated_users_can_create_projects() {
        $attributes = ProjectFactory::new()->raw(['owner_id' => null]);

        $this->post('/projects', array_merge($attributes))->assertRedirect('login');
    }
    
    public function test_guests_cannot_view_projects() {
        $this->get('/projects')->assertRedirect('login');
    }

    public function test_guests_cannot_view_a_single_project() {
        $project = ProjectFactory::new()->create();

        $this->get($project->path())->assertRedirect('login');
    }
}
