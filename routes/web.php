<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;

Route::get('dbauth', [SsoController::class, 'dbauth']);

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
            });
            
Route::middleware('auth')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('files.index');
    Route::get('/create', [FileController::class, 'create'])->name('files.create');
    Route::post('/store', [FileController::class, 'store'])->name('files.store');
    Route::get('/download/{file}', [FileController::class, 'download'])->name('files.download');
    Route::delete('/delete/{id}', [FileController::class, 'destroy'])->name('files.delete');
});

Route::fallback(function () {
    return view('errors.404');
});

require __DIR__.'/auth.php';
