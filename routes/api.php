<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::middleware('is_admin')->group(function () {
                Route::get('/', [AuthController::class, 'users']);
            });
            Route::get('/profile', [AuthController::class, 'user']);
            Route::put('/{id}', [AuthController::class, 'updateUser']);
            Route::delete('/{id}', [AuthController::class, 'deleteUser']);
            Route::post('/password-reset', [AuthController::class, 'passwordReset']);
        });
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'categories']);
    Route::get('/{id}', [CategoryController::class, 'category']);
    Route::middleware(['auth:api', 'is_admin'])->group(function () {
        Route::post('/add', [CategoryController::class, 'addCategory']);
        Route::put('/update/{id}', [CategoryController::class, 'updateCategory']);
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory']);
    });
});

Route::prefix('product')->group(function(){
    Route::get('/',[ProductController::class,'products']);
    Route::get('/{id}',[ProductController::class,'product']);
    Route::middleware(['auth:api','is_admin'])->group(function(){
        Route::post('/add',[ProductController::class,'addProduct']);
        Route::put('/update/{id}',[ProductController::class,'updateProduct']);
        Route::delete('/delete/{id}',[ProductController::class,'deleteProduct']);
    });
});
