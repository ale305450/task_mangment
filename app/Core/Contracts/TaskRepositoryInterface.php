<?php

namespace App\Core\Contracts;

use App\Core\DTOs\Tasks\TaskDTO;
use App\Core\Entities\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function all(): Collection;
    public function create(TaskDTO $data): Task;
    public function find($id): Task;
    public function update($id, TaskDTO $data): Task;
    public function delete($id);
}
