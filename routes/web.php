<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminController::class, 'index'])->name('admin.pannel');
Route::get('/courses',[CourseController::class, 'index'])->name('courses');
Route::get('/trainers',[TrainerController::class, 'index'])->name('trainers');

Route::post('/process-course',[CourseController::class, 'store'])->name('process.course');
Route::post('/process-trainer',[TrainerController::class, 'store'])->name('process.trainer');

Route::get('/edit-course/{id}',[CourseController::class, 'edit'])->name('edit.course');
Route::post('/update-course',[CourseController::class, 'update'])->name('update.course');
Route::get('/delete-course/{id}',[CourseController::class, 'destroy'])->name('delete.course');
 
Route::get('/edit-trainer/{id}',[TrainerController::class, 'edit'])->name('edit.trainer');
Route::post('/update-trainer',[TrainerController::class, 'update'])->name('update.trainer');
Route::get('/delete-trainer/{id}',[TrainerController::class, 'destroy'])->name('delete.trainer');

 


 



