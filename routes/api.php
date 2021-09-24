<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function(){
    Route::prefix('user')->group(function(){
        Route::middleware('auth:api')->group(function(){
            Route::middleware('is_admin')->group(function(){
                Route::get('/',[AuthController::class,'users']);
            });
            Route::get('/profile',[AuthController::class,'user']);
            Route::put('/{id}',[AuthController::class,'updateUser']);
            Route::delete('/{id}',[AuthController::class,'deleteUser']);
            Route::post('/password-reset',[AuthController::class,'passwordReset']);
        });
        Route::post('/login',[AuthController::class,'login']);
        Route::post('/register',[AuthController::class,'register']);

    });
});
