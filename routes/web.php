<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('student.index');
})->name('frontend.home');

Route::resource('student',StudentController::class);
Route::get('student-status/{id}',[StudentController::class,'status'])->name('status_change');
