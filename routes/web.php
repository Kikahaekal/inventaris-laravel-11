<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'register']);
Route::post('/login_user', [UserController::class, 'login_user']);
Route::post('/create_user', [UserController::class, 'create_user']);

Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::resource('categories', CategoryController::class);
Route::resource('items', ItemController::class);

Route::get('/logout', [UserController::class, 'logout']);
