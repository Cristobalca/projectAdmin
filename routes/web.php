<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;


Route::get('/',[ProjectController::class, 'index'])->name('projects.index')->middleware('auth');


Auth::routes(["register" => false,'password.reset'=>false,'reset'=>false]);

Route::get('tasks/{id}/create' , [TaskController::class, 'create'])->name('tasks.create')->middleware('auth');
Route::resource('tasks', TaskController::class)->except('create','index')->middleware('auth');;
