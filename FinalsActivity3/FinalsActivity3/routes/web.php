<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::resource('students', StudentController::class);
