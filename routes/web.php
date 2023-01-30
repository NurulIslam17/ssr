<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('student.index');
})->name('frontend.home');

Route::resource('student',StudentController::class);
Route::get('student-status/{id}',[StudentController::class,'status'])->name('status_change');
Route::post('student_delete/',[StudentController::class,'delete'])->name('student_delete');
Route::post('edit_data/',[StudentController::class,'editData'])->name('edit_data');
Route::post('update_data/',[StudentController::class,'updateData'])->name('update_data');
