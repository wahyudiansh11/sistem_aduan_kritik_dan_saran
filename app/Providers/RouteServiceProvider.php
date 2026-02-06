<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path default setelah login.
     * Admin akan diarahkan ke dashboard.
     */
    public const HOME = '/dashboard';

    /**
     * Define route model bindings, pattern filters, dll.
     */
    public function boot(): void
    {
        $this->routes(function () {

            // ROUTE WEB (browser)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // ROUTE API (kalau ada)
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
