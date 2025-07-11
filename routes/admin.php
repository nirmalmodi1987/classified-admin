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
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');

    // Password Reset Routes
    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])
        ->name('admin.password.request');  // Correctly named
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])
        ->name('admin.password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])
        ->name('admin.password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])
        ->name('admin.password.update');
});

// Protected Routes (Authenticated Admins)
Route::middleware(['auth:admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AuthController::class, 'showProfile'])->name('show');
        Route::put('/', [AuthController::class, 'updateProfile'])->name('update');
        Route::put('/password', [AuthController::class, 'updatePassword'])->name('password');
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
    // Main resource
    // Route::resource('users', UserController::class)->except(['update']);
    // Additional user routes
    Route::post('users/{user}/toggle-active', [UserController::class, 'toggleActive'])
        ->name('users.toggle-active');
    Route::post('users/{user}/toggle-verified', [UserController::class, 'toggleVerified'])
        ->name('users.toggle-verified');
    Route::match(['GET', 'POST'], 'users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');
    Route::match(['GET', 'POST', 'PUT'], 'users/{user}/update', [UserController::class, 'update'])
        ->name('users.update');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    
    //Route::prefix('users/{user}')->group(function () {
    // Route::post('ban', [UserController::class, 'ban'])->name('users.ban');
    // Route::post('unban', [UserController::class, 'unban'])->name('users.unban');
    //});

    // Locations Management
    Route::resource('locations', LocationController::class)->except(['show']);
});

// Redirect root to login
Route::redirect('/', '/admin/login');
