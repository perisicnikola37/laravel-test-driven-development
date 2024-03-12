<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
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
}
