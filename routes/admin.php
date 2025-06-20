<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    DashboardController,
    CategoryController,
    AdController,
    UserController,
    LocationController
};

// Public Routes (Unauthenticated Admins)
Route::middleware('guest:admin')->group(function () {

    // Login Routes
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    // Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    // Route::post('login', [AuthController::class, 'login']);

    // Password Reset Routes
    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])
        ->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Protected Routes (Authenticated Admins)
Route::middleware(['web', 'auth:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Profile Management
    Route::prefix('profile')->group(function () {
        Route::get('/', [AuthController::class, 'showProfile'])->name('profile');
        Route::put('/', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [AuthController::class, 'updatePassword'])->name('profile.password');
    });
    // Categories Management
    Route::resource('categories', CategoryController::class)->except(['show']);
    // Ads Management
    Route::resource('ads', AdController::class);
    Route::prefix('ads/{ad}')->group(function () {
        Route::post('approve', [AdController::class, 'approve'])->name('ads.approve');
        Route::post('reject', [AdController::class, 'reject'])->name('ads.reject');
        Route::post('feature', [AdController::class, 'feature'])->name('ads.feature');
    });
    // Users Management
    Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users', [UserController::class, 'create'])->name('admin.users.create');
    Route::prefix('users/{user}')->group(function () {
        Route::post('ban', [UserController::class, 'ban'])->name('users.ban');
        Route::post('unban', [UserController::class, 'unban'])->name('users.unban');
    });

    // Locations Management
    Route::resource('locations', LocationController::class)->except(['show']);
});
