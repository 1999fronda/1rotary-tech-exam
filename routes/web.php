<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');

    Route::prefix('projects')->group(function () {
        Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{project}/delete', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
});
