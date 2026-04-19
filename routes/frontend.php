<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Frontend\TaskController;


Route::get('/', [TaskController::class, 'index'])->name('home');
Route::get('/task/{id}', [TaskController::class, 'show'])->name('frontend.task.show');