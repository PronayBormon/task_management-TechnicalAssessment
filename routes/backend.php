<?php

use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\TaskController;
use Illuminate\Support\Facades\Route;

// Dashboard route 
Route::controller(DashboardController::class)->group(function(){
    Route::get('/dashboard', 'index')->name('admin.dashboard.index');
});


// Task routes 
Route::controller(TaskController::class)->group(function(){
    Route::get('/task', 'index')->name('admin.task.index');
    Route::get('/task/create', 'create')->name('admin.task.create');
    Route::post('/task/store', 'store')->name('admin.task.store');
    Route::get('/task/edit/{id}', 'edit')->name('admin.task.edit');
    Route::put('/task/update/{id}', 'update')->name('admin.task.update');
    Route::delete('/task/destroy/{id}', 'destroy')->name('admin.task.destroy');
});
