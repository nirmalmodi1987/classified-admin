<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureRoutes();
    }

    protected function configureRoutes(): void
    {
        Route::middleware('web')
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));
    }
}