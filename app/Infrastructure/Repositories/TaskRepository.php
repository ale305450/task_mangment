<?php

namespace App\Infrastructure\Repositories;

use App\Core\Contracts\TaskRepositoryInterface;
use App\Core\DTOs\Tasks\TaskDTO;
use App\Core\Entities\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(): Collection
    {
        return Task::with(['users:id,name,email', 'projects:id,name', 'categories:id,name'])->get();
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
        return Task::with(['users:id,name,email', 'projects:id,name', 'categories:id,name'])->findOrFail($id);
    }
    public function update($id, TaskDTO $taskDTO): Task
    {
        $task  = $this->find($id);
        //check if the user is the owner of the project the task belongs to
        Gate::authorize('update', $task);
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
        //check if the user is the owner of the project the task belongs to
        Gate::authorize('delete', $task);
        $task->delete();
    }
    public function completed($id): Task
    {
        $task = $this->find($id);
        $task->status = 'completed';
        $task->update();
        return  $task;
    }
}
