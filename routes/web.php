<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProjectController::class, 'index'])->name('projects.index')->middleware('auth');


Auth::routes();

Route::get('tasks/{id}/create' , [TaskController::class, 'create'])->name('tasks.create');
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class)->except('create');
// Route::get('/home', [App\Http\Controllers\HomeCjuontroller::class, 'index'])->name('home');

Route::resource('/role', RoleController::class)->names('role');

Route::resource('/user', UserController::class)->names('user');
