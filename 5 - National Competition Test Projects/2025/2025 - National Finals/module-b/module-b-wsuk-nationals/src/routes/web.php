<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventAccessController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PictureSizeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Authenticated User Rotes
 */
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('/settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');

        // Categories
        Route::resource('/categories', CategoryController::class)->only('index', 'store', 'update', 'destroy');

        // Picture Sizes
        Route::resource('/picture-sizes', PictureSizeController::class)->only('index', 'store', 'update', 'destroy');

        // Users
        Route::resource('/users', UserController::class)->only('index', 'create', 'store', 'destroy');
        Route::post('/users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
        Route::post('/users/{user}/unsuspend', [UserController::class, 'unsuspend'])->name('users.unsuspend');
    });


    // Pictures
    Route::resource('/pictures', PictureController::class)->except('show');

    Route::get('/events/{event}/access', [EventController::class, 'createAccess'])->name('events.access');
    Route::post('/events/{event}/access', [EventAccessController::class, 'store'])->name('events.access.store');
    Route::patch('/events-access/{access}', [EventAccessController::class, 'toggle'])->name('events.access.toggle');
    Route::delete('/events-access/{access}', [EventAccessController::class, 'destroy'])->name('events.access.destroy');

    // Events
    Route::patch('/events/{event}/toggle', [EventController::class, 'toggle'])->name('events.toggle');
    Route::resource('/events', EventController::class)->except('show');

    // Orders
    Route::resource('/orders', OrderController::class)->only('index', 'show', 'update', 'destroy');
});

/**
 * Guest Routes
 */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// Public Events
Route::get('/public-events', [EventController::class, 'publicEvents'])->name('events.public');

// Access Code Verification
Route::get('/verify-access-code', [EventAccessController::class, 'verifyAccessCode'])->name('events.access.verify');

// Events Access - includes `.*` wildcard to allow including slashes in the path
Route::get('/events/{path}', [EventAccessController::class, 'show'])->where('path', '.*')->name('events.show');
