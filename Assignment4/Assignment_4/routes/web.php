<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('insert', [StudentController::class, 'insertform']);
Route::post('create', [StudentController::class, 'insert']);

Route::get('/view-records', [StudentController::class, 'show']);

Route::get('delete/{id}', [StudentController::class, 'destroy']);

Route::get('edit/{id}', [StudentController::class, 'edit']);

Route::post('update/{id}', [StudentController::class, 'update']);