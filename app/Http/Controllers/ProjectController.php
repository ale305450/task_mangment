<?php

namespace App\Http\Controllers;

use App\Core\Contracts\ProjectRepositoryInterface;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    /**
     * Display a listing of all projects.
     */
    public function index()
    {
        //get all projects in db
        $projects = $this->projectRepository->all();

        return response()->json(['data' => $projects]);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        $project = $this->projectRepository->create($request->toDto());
        return response()->json(['data' => $project]);
    }

    /**
     * Display the specified project.
     */
    public function show($id)
    {
        //find project by it id
        $project = $this->projectRepository->find($id);

        if ($project == null) {
            return response()->json([
                'data' => 'There is no category with that id'
            ]);
        }

        return response()->json(['data' => $project]);
    }

    /**
     * Update project in storage.
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        //update project by it id
        $project = $this->projectRepository->update($id, $request->toDto());

        return response()->json(['data' => $project]);
    }

    /**
     * Remove project from storage.
     */
    public function destroy($id)
    {
        //Delete the project by it id
        $this->projectRepository->delete($id);

        return response()->json([
            'success' => 'The project has been deleted'
        ]);
    }
}
