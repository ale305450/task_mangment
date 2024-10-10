<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\TaskRepositoryInterface;
use App\Core\DTOs\Tasks\TaskDTO;
use App\Core\Entities\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(): Collection
    {
        return Task::with(['users', 'projects', 'categories'])->get();
    }
    public function create(TaskDTO $taskDTO): Task
    {
        $task  = Task::create([
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'status' => $taskDTO->status,
            'due_date' => $taskDTO->due_date,
            'category_id' => $taskDTO->category_id,
            'project_id' => $taskDTO->project_id
        ]);
        $task->users()->attach($taskDTO->user_id);

        return $task;
    }
    public function find($id): Task
    {
        return Task::find($id);
    }
    public function update($id, TaskDTO $taskDTO): Task
    {
        $task  = $this->find($id);
        $task->update([
            'title' => $taskDTO->title,
            'description' => $taskDTO->description,
            'status' => $taskDTO->status,
            'due_date' => $taskDTO->due_date,
            'category_id' => $taskDTO->category_id,
            'project_id' => $taskDTO->project_id
        ]);

        $task->users()->sync($taskDTO->user_id);

        return $task;
    }
    public function delete($id)
    {
        $task = $this->find($id);
        $task->delete();
    }
}
