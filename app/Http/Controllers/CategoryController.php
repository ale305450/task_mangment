<?php

namespace App\Http\Controllers;

use App\Core\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all categories in db.
     */
    public function index()
    {
        //Get all category in db
        $allCategories = $this->categoryRepository->all();

        // Return all of category as a JSON response
        return response()->json([
            'data' => $allCategories
        ]);
    }

    /**
     * Create category.
     */
    public function store(CreateCategoryRequest $request)
    {
        //Create category and get it info
        $category = $this->categoryRepository->create($request->toDto());

        // Return the category as a JSON response
        return response()->json($category, 201);
    }

    /**
     * Show specific category.
     */
    public function show($id)
    {
        //Get the specific category by it id
        $category = $this->categoryRepository->find($id);

        if ($category == null) {
            return response()->json([
                'data' => 'There is no category with that id'
            ]);
        } else {
            // Return the specific category as a JSON response
            return response()->json([
                'data' => $category
            ]);
        }
    }

    /**
     * Update the category.
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        //Update the categoty by it id
        $category = $this->categoryRepository->update($id, $request->toDto());

        // Return the updated category as a JSON response
        return response()->json([
            'data' => $category
        ]);
    }

    /**
     * Delete category.
     */
    public function delete($id)
    {
        //Delete the categoty by it id
        $this->categoryRepository->delete($id);
        return response()->json([
            'success' => 'The category has been deleted'
        ]);
    }
}
