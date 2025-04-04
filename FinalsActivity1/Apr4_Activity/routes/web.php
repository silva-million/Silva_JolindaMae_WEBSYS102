<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get("/", [RegisterController::class, 'showRegistrationForm']);
Route::post("/register", [RegisterController::class, 'register'])->name('register');

Route::get("/login", [LoginController::class, 'showLoginForm'])->name('login');
Route::post("/login", [LoginController::class, 'login']);
Route::get('/dashboard', [LoginController::class,'dashboard'])->name('dashboard');
Route::post("/logout", [LoginController::class, 'logout'])->name('logout');
