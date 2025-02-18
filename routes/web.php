<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DailyReportController;
use Illuminate\Support\Facades\Route;

// Redirect ke login jika belum auth
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard - Semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Reports - Admin & Manager only
    Route::middleware(['role:Admin,Manager'])->group(function () {
        Route::get('/reports', [ReportsController::class, 'index'])
            ->name('reports');
    });

    // Settings - Admin only
    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])
            ->name('settings');
        Route::put('/settings', [SettingsController::class, 'update'])
            ->name('settings.update');
    });

    // User Management - Admin & Manager
    Route::middleware(['role:Admin,Manager'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Attendance routes
    Route::controller(AttendanceController::class)->group(function () {
        Route::post('/attendance/check-in', 'checkIn')->name('attendance.check-in');
        Route::post('/attendance/check-out', 'checkOut')->name('attendance.check-out');
    });

    // Daily Report routes
    Route::controller(DailyReportController::class)->group(function () {
        Route::post('/daily-report', 'store')->name('daily-report.store');
    });
});

require __DIR__.'/auth.php';
