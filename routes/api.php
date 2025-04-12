<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



// cach 1 
Route::apiResource('/categories', CategoryController::class);

// cach 2
Route::get('/users', [UserController::class, 'index']);


// api stantum
Route::get('/', [AuthController::class, 'index']);
Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);