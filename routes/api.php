<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('lists/categories', [\App\Http\Controllers\Api\CategoryController::class, 'list']) ;
//Route::get('categories', [CategoryController::class, 'index']);
//Route::get('categories/{category}', [CategoryController::class, 'show']);
//Route::post('categories', [CategoryController::class, 'store']);
//Route::delete('categories/{category}', [\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
//Route::put('categories/{category}', [\App\Http\Controllers\Api\CategoryController::class, 'update']);
Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class); //5in1
Route::get('products', [\App\Http\Controllers\Api\ProductController::class, 'index']);

