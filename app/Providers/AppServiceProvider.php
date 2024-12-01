<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // See @https://laravel.com/docs/11.x/routing#rate-limiting
        RateLimiter::for('public_api', function (Request $request) {
            return $request->user()
                        ? Limit::perMinute(100)->by($request->user()->id)
                        : Limit::perMinute(10)->by($request->ip());
        });
    }
}
