<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ {
    Project,
    Task
};
use Illuminate\Support\Facades\Auth;

class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        if(Auth::id() !== ($project->owner_id)) {
            abort(403);
        }
        
        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.  
     */
    public function update(Request $request, Project $project, Task $task)
    {
        if(Auth::id() !== ($project->owner_id)) {
            abort(403);
        }

        request()->validate(['body' => 'required']);

        $task->update([
            'body' => $request->body,
            'completed' => $request->has('completed')
        ]);

        return redirect($project->path());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
