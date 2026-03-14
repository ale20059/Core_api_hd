<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\BiographyAuthController;
use App\Http\Controllers\Api\Auth\ProductAuthController;
use App\Http\Controllers\Api\v1\BiographyController;
use App\Http\Controllers\Api\v1\ContactoController;
use App\Http\Controllers\Api\v1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



#---------------------------------------------------------------------------------------------------------------------


#rutas privadas

Route::prefix('dropin_lauch_private')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');



    Route::get('/biography', [BiographyController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/biography', [BiographyAuthController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/biography/{id}', [BiographyAuthController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/biography/{id}', [BiographyAuthController::class, 'destroy'])->middleware('auth:sanctum');



    Route::get('/products', [ProductController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/products/', [ProductAuthController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/products/{id}', [ProductAuthController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/products/{id}', [ProductAuthController::class, 'destroy'])->middleware('auth:sanctum');
});





#rutas publicas

Route::prefix('v1')->group(function () {
    Route::get('/biography', [BiographyController::class, 'index']);



    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);
    Route::get('/products/{id}/download', [ProductController::class, 'download']);


    Route::post('/contact', [ContactoController::class, 'store']);
});
