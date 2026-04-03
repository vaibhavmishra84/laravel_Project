<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Product Routes
Route::get('/products', [APIProductController::class, 'index']);
Route::post('/products', [APIProductController::class, 'store']);

// Order Routes
Route::post('/orders', [OrderController::class, 'store']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/orders', [OrderController::class, 'index']);
});
// bdsjsbfjsdbkasfbakjsfbaisfbiokkj