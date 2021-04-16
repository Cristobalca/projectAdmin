<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::resource('projects', ProjectController::class);
Route::resource('/role', RoleController::class)->names('role');
Route::resource('/user', UserController::class)->names('user');
