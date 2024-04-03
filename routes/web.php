<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('importView');
});
Route::post('/import',[CustomerController::class, 'import'])->name('import');
Route::get('/export',[CustomerController::class, 'export'])->name('export');

Route::get('users', [UserController::class, 'index']);
Route::get('users-export', [UserController::class, 'export'])->name('users.export');
Route::post('users-import', [UserController::class, 'import'])->name('users.import');
