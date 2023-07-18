<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        Blade::directive('admin', function () {
            return '<?php if (Auth::check() && Auth::user()->Admin()) : ?>';
        });
    
        Blade::directive('endadmin', function () {
            return '<?php endif; ?>';
        });
    }
}
