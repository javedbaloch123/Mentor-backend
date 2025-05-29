<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\TrainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/courses',[CourseController::class, 'index']);
Route::get('/courses/{id}',[CourseController::class, 'Single']);


Route::get('/trainers',[TrainerController::class, 'index']);

Route::post('/contact',[ContactController::class, 'store']);