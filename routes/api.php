<?php

use App\Http\Controllers\Api\studentController;
use Illuminate\Support\Facades\Route;

Route::get('/students', [studentController::class, 'index']);

Route::post('/students', [studentController::class, 'store']);

Route::get('/students/{id}', [studentController::class, 'show']);

Route::delete('/students/{id}', [studentController::class, 'destroy']);

Route::put('/students/{id}', [studentController::class, 'update']);

Route::patch('/students/{id}', [studentController::class, 'updatePartial']);



