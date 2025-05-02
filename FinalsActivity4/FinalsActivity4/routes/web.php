<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;

Route::get('/upload', [PhotoController::class, 'index'])->name('photos.index');
Route::post('/upload-single', [PhotoController::class, 'storeSingle'])->name('photos.store.single');
Route::post('/upload-multiple', [PhotoController::class, 'storeMultiple'])->name('photos.store.multiple');
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
