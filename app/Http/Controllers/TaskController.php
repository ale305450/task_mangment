<?php

namespace App\Http\Controllers;

use App\Core\Contracts\TaskRepositoryInterface;
use App\Http\Requests\Tasks\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $tasks = $this->taskRepository->all();
        return response()->json([
            'data' => $tasks
        ]);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(TaskRequest $request)
    {
        $request->toDto()->user_id =  $request->input('user_id', []);
        $task =  $this->taskRepository->create($request->toDto());
        return $task;
    }

    /**
     * Display the specified task.
     */
    public function show($id)
    {
        $task =  $this->taskRepository->find($id);
        return response()->json(['data' => $task]);
    }

    /**
     * Update the task in storage.
     */
    public function update(TaskRequest $request, $id)
    {
        $request->toDto()->user_id =  $request->input('user_id', []);
        $task =  $this->taskRepository->update($id, $request->toDto());
        return $task;
    }

    /**
     * Remove the task from storage.
     */
    public function destroy($id)
    {
        //Delete the task by it id
        $this->taskRepository->delete($id);

        return response()->json([
            'success' => 'The task has been deleted'
        ]);
    }

    /**
     * Change the task status.
     */
    public function complete($id)
    {
        //Delete the task by it id
        $task = $this->taskRepository->completed($id);

        return response()->json([
            'success' => 'The task has been completed',
            'data' => $task
        ]);
    }
}
