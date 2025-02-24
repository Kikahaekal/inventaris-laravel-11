<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['isGuest'])->group(function () {
    Route::get('/', [UserController::class, 'login']);
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/login_user', [UserController::class, 'login_user']);
    Route::post('/create_user', [UserController::class, 'create_user']);
});

Route::middleware(['isLogin'])->group(function() {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/user-profile/{id}', [UserController::class, 'user_profile']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('items', ItemController::class);
});

Route::get('/logout', [UserController::class, 'logout']);
