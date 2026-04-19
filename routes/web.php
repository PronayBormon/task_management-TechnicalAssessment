<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('admin.dashboard.index');
// });

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard.index');
})->name('dashboard');

require base_path('routes/auth.php');
require base_path('routes/frontend.php');
Route::prefix('admin')->middleware('auth:sanctum' , 'admin')->group(function () {
    require base_path('routes/backend.php');
});

