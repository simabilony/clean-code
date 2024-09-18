<?php

use App\Http\Controllers\Api\CategoryController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('lists/categories', [\App\Http\Controllers\Api\CategoryController::class, 'list']) ;
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::post('categories', [CategoryController::class, 'store']);
Route::put('categories/{category}', [CategoryController::class, 'update']);
Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
//Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class); //5in1
Route::get('products', [\App\Http\Controllers\Api\ProductController::class, 'index'])
    ->middleware('throttle:products');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class)
            ->middleware('auth:sanctum');
    Route::get('products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
});

//Authentication with Laravel Sanctum and Mobile Apps
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
