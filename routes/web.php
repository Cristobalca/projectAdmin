<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProjectController::class, 'index'])->name('projects.index');


Auth::routes();

Route::get('tasks/{id}/create' , [TaskController::class, 'create'])->name('tasks.create');
Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class)->except('create');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
