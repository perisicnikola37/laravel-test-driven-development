<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private function signInUser(): void
    {
        $this->signIn();
    }

    public function test_a_guests_cannot_manage_projects()
    {
        $project = Project::factory()->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get('/projects/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

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
        $this->signInUser();

        $attributes = [
            'description' => $this->faker->paragraph,
        ];

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->signInUser();

        $attributes = [
            'title' => $this->faker->sentence,
        ];

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    public function test_a_user_can_view_their_project()
    {
        $this->signInUser();

        $project = ProjectFactory::new ()->create(['owner_id' => Auth::id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signInUser();

        $project = ProjectFactory::new ()->create();

        $this->get($project->path())->assertSee(403);
    }

    public function test_no_projects_in_database()
    {
        Project::truncate();

        $this->assertDatabaseCount('projects', 0);

        $this->get('/projects')->assertRedirect('login');
    }

    public function test_only_authenticated_users_can_create_projects()
    {
        $attributes = ProjectFactory::new ()->raw(['owner_id' => null]);

        $this->post('/projects', array_merge($attributes))->assertRedirect('login');
    }

    public function test_guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    public function test_guests_cannot_view_a_single_project()
    {
        $project = ProjectFactory::new ()->create();

        $this->get($project->path())->assertRedirect('login');
    }

    public function test_a_user_can_update_a_project()
    {
        $this->signInUser();

        $project = Project::factory()->create(['owner_id' => Auth::id()]);
        $newAttributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->patch($project->path(), $newAttributes);

        $this->assertDatabaseHas('projects', $newAttributes);

        $this->get($project->path())
            ->assertSee($newAttributes['title'])
            ->assertSee($newAttributes['description'])
            ->assertOk();
    }

    public function test_a_user_can_delete_a_project()
    {
        $this->signInUser();

        $project = Project::factory()->create(['owner_id' => Auth::id()]);

        $this->delete($project->path());

        $this->assertDatabaseMissing('projects', $project->only('id'));
    }
}
