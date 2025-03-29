<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/form', [FormController::class, 'registration']);
Route::post('/form/registered', [FormController::class, 'register'])->name('simple-form');
