<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MusicController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/music', [MusicController::class, 'store']);
    Route::get('/music', [MusicController::class, 'index']);
});
