<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\ {
    ProjectController,
    ProjectTaskController
};

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    
    Route::post('/projects/{project}/tasks', [ProjectTaskController::class, 'store']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();

