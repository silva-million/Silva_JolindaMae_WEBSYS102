<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::get('/anime/{title}', [AnimeController::class, 'search']);



