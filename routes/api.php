<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Un singed user can access
Route::middleware('guest')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});

//Singed user can access
Route::middleware('auth:sanctum')->group(function () {

    //Route::resource('category', CategoryController::class)->middleware('role:Admin');
    Route::get('category', [CategoryController::class, 'index'])->middleware('permission:All-categories');
    Route::post('category', [CategoryController::class, 'store'])->middleware('permission:Add-category');
    Route::get('category/{category}', [CategoryController::class, 'show']);
    Route::put('category/{category}', [CategoryController::class, 'update'])->middleware('permission:Edit-category');
    Route::delete('category/{category}', [CategoryController::class, 'delete'])->middleware('permission:Delete-category');

    //Route::resource('project', ProjectController::class);
    Route::get('project', [ProjectController::class, 'index'])->middleware('permission:All-projects');
    Route::post('project', [ProjectController::class, 'store'])->middleware('permission:Add-project');
    Route::get('project/{project}', [ProjectController::class, 'show']);
    Route::put('project/{project}', [ProjectController::class, 'update'])->middleware('permission:Edit-project');
    Route::delete('project/{project}', [ProjectController::class, 'delete'])->middleware('permission:Delete-project');

    //Route::resource('task', TaskController::class);
    Route::get('task', [TaskController::class, 'index'])->middleware('permission:All-tasks');
    Route::post('task', [TaskController::class, 'store'])->middleware('permission:Add-task');
    Route::get('task/{task}', [TaskController::class, 'show']);
    Route::put('task/{task}', [TaskController::class, 'update'])->middleware('permission:Edit-task');
    Route::delete('task/{task}', [TaskController::class, 'delete'])->middleware('permission:Delete-task');
    Route::get('task/complete/{task}', [TaskController::class, 'complete'])->middleware('permission:Task-compelete');

    Route::middleware(['web'])->group(function () {
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });
    //Route::post('logout', [UserController::class, 'logout']);
});
