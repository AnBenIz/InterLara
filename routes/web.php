<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicViewController;
use App\Http\Controllers\AuthController;

Route::get('/music', [MusicViewController::class, 'index'])->name('music.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function() {
    // Lista de canciones del usuario
    Route::get('/music', [MusicViewController::class, 'index'])->name('music.index');
    // Formulario para agregar una nueva canción
    Route::get('/music/create', [MusicViewController::class, 'create'])->name('music.create');
    // Procesa el formulario para almacenar la nueva canción
    Route::post('/music', [MusicViewController::class, 'store'])->name('music.store');
});
