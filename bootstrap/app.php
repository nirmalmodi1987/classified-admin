<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
        Route::middleware('web')
            ->prefix('admin')
            ->group(base_path('routes/admin.php')); // Removed ->name('admin.')
    }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web([
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\EnsureAdminIsAuthenticated::class,
            // Add your admin middleware here if needed globally
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withProviders([
        App\Providers\AdminRouteServiceProvider::class,
    ])
    ->create();
