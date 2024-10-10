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

Route::resource('category', CategoryController::class);
Route::resource('project', ProjectController::class);
Route::resource('task', TaskController::class);

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
