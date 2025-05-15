<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::put('/profile/updatePassword', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');

    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/facilities/create', [FacilityController::class, 'create'])->name('facilities.create');
        Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
        Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
        Route::put('/facilities/{facility}', [FacilityController::class, 'update'])->name('facilities.update');
        Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy'])->name('facilities.destroy');
    });

    Route::get('/facilities/{facility}', [FacilityController::class, 'show'])->name('facilities.show');

    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::put('/schedules/{schedule}/approve-reject', [ScheduleController::class, 'approveReject'])->name('schedules.approve-reject');
        Route::get('/schedules/cleanup', [ScheduleController::class, 'manualCleanup'])->name('schedules.cleanup');
    });

    Route::middleware('can:isUser')->group(function () {
        Route::get('/schedules/{facility}/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/schedules/{facility}/store', [ScheduleController::class, 'store'])->name('schedules.store');
        Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
        Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');            
    });

    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
});

require __DIR__.'/auth.php';