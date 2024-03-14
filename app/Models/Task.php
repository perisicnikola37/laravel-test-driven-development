<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    protected function recordActivity($type)
    {
        Activity::create([
            'project_id' => $this->project->id,
            'description' => $type,
        ]);
    }

    public function complete()
    {
        $this->update(['completed' => true]);
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($project) {
            $project->recordActivity('created_task');
        });

        self::updated(function ($project) {
            $project->recordActivity('updated_task');
        });
    }
}
