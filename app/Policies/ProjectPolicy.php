<?php

namespace App\Policies;

use App\Core\Entities\User;
use  App\Core\Entities\Project;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        return  $user->id === $project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return  $user->id === $project->user_id;
    }
}
