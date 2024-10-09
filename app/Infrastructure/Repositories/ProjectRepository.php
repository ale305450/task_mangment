<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\ProjectRepositoryInterface;
use App\Core\DTOs\Projects\ProjectDTO;
use App\Core\Entities\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function all(): Collection
    {
        //$categorirs = Project::select('id', 'name', 'description')->with('categories')->get();
        $projects = Project::select('id', 'name', 'description', 'category_id')
            ->with('categories:id,name') // Here we are explicitly selecting the fields we want
            ->get();
        dd($projects);
        return Project::select('id', 'name', 'description')->with('category')->get();
    }
    public function create(ProjectDTO $projectDTO): Project
    {
        return Project::create([
            'name' => $projectDTO->name,
            'description' => $projectDTO->description,
            'category_id' => $projectDTO->category_id
        ]);
    }
    public function find($id): Project
    {
        return Project::find($id);
    }
    public function update($id, ProjectDTO $projectDTO): Project
    {
        $project = $this->find($id);
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
        $project->delete();
    }
}
