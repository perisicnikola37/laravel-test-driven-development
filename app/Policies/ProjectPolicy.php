<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Assuming all users can view projects
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Assuming all users can create projects
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return false; // Assuming restoration is not allowed
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false; // Assuming force deletion is not allowed
    }
}
