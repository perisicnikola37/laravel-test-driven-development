<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    protected function recordActivity($project, $type)
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => $type,
        ]);
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($project) {
            $project->recordActivity($project, 'Created');
        });

        self::updated(function ($project) {
            $project->recordActivity($project, 'Updated');
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
