<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductController1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// trang chu
Route::get('/', function () {
    return view('client.home');
});

// dang ky
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

// login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

// phân quyền cho client
Route::middleware('client')->group(function () {
    Route::get('/list', [ClientController::class, 'index']) -> name('client.list');
    Route::get('/detail/{id}', [ClientController::class, 'detail']) -> name('client.detail');
});
// phân quyền cho admin
Route::middleware('admin')->group(function () {
    Route::resource('/categories', CategoryController::class);
    Route::get('/products/trash', [ProductController1::class, 'trash'])->name('products.trash');
    Route::post('/products/{product}/restore', [ProductController1::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete', [ProductController1::class, 'forceDelete'])->name('products.force-delete');
    Route::resource('/products', ProductController1::class);
});


//logout
Route::post('/logout', function () {
    Auth::logout();
    return view('auth.login');
})->name('logout');
