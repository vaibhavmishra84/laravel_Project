<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIProductController;

Route::get('/products', [APIProductController::class, 'index']);
Route::post('/products', [APIProductController::class, 'store'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/', function () {
    return view('welcome');
});
