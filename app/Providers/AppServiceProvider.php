<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

Response::macro('noCache', function ($response) {
    return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
});

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
         // Paksa semua URL pakai https di production
    if (env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }

    // Tambahkan macro noCache
    Response::macro('noCache', function ($response) {
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
