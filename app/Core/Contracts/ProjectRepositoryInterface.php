<?php

namespace App\Core\Contracts;

use App\Core\DTOs\Projects\ProjectDTO;
use App\Core\Entities\Project;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryInterface
{
    public function all(): Collection;
    public function create(ProjectDTO $data): Project;
    public function find($id): Project;
    public function update($id, ProjectDTO $data): Project;
    public function delete($id);
}
