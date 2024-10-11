<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\ProjectRepositoryInterface;
use App\Core\DTOs\Projects\ProjectDTO;
use App\Core\Entities\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function all(): Collection
    {
        $projects = Project::select('id', 'name', 'description', 'category_id')
            ->with('categories:id,name') // Here we are explicitly selecting the fields we want
            ->get();
        return $projects;
    }
    public function create(ProjectDTO $projectDTO): Project
    {
        //Get the id of the current user
        $user_id = Auth::user()->id;
        return Project::create([
            'name' => $projectDTO->name,
            'description' => $projectDTO->description,
            'category_id' => $projectDTO->category_id,
            'user_id' => $user_id,
        ]);
    }
    public function find($id): Project
    {
        return Project::find($id);
    }
    public function update($id, ProjectDTO $projectDTO): Project
    {
        $project = $this->find($id);
        //check the user if it is the owner of the project
        Gate::authorize('update', $project);

        $project->update([
            'name' => $projectDTO->name,
            'description' => $projectDTO->description,
            'category_id' => $projectDTO->category_id
        ]);
        return $project;
    }
    public function delete($id)
    {
        $project = $this->find($id);
        //check if the user is the owner of the project
        Gate::authorize('delete', $project);
        $project->delete();
    }
}
