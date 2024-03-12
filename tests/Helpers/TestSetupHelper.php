<?php

namespace Tests\Helpers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TestSetupHelper extends TestCase
{
    public static function setUpProject(TestCase $testCase)
    {
        $testCase->signIn();

        $user = Auth::user();
        $project = Project::factory()->create();

        return $project;
    }

    public static function setUpProjectWithTask(TestCase $testCase)
    {
        $testCase->signIn();

        $user = Auth::user();
        $project = $user->projects()->create(Project::factory()->raw());
        $project->addTask('Test task');

        return $project;
    }
}
