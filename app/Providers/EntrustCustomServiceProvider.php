<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class EntrustCustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('permission', function ($expression) {
            return "<?php if (Auth::guard('admin')->user()->can({$expression})) : ?>";
        });

        Blade::directive('endpermission', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
