<?php

namespace Tests\Helpers;

use Tests\TestCase;

class TestEndpointHelper extends TestCase
{
    public static function getTaskInProject(TestCase $testCase, $project, $body)
    {
        return $testCase->post($project->path() . '/tasks', ['body' => $body]);
    }

    public static function postTaskToProject(TestCase $testCase, $project, $body)
    {
        return $testCase->get($project->path())->assertSee($body);
    }
}
