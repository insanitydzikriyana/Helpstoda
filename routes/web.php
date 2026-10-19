<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\HelpdeskRecordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [HelpdeskRecordController::class, 'dashboard'])->name('dashboard');
    Route::get('/records/{record}/attachment', [HelpdeskRecordController::class, 'downloadAttachment'])->name('records.attachment');
    Route::resource('records', HelpdeskRecordController::class)->except(['show']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
