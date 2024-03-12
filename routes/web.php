<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('projects', ProjectController::class);

    Route::post('/projects/{project}/tasks', [ProjectTaskController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTaskController::class, 'update']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
