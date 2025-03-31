<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FormController::class, 'index'])->name('dashboard');
    Route::get('/form/create', [FormController::class, 'create'])->name('form.create');
    Route::post('/form/store', [FormController::class, 'store'])->name('form.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/form/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
    Route::put('/form/update/{id}', [FormController::class, 'update'])->name('form.update');
    Route::delete('/form/delete/{id}', [FormController::class, 'destroy'])->name('form.destroy');
});
