<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // appLandingTemplate
        view()->share('appLanding', 'landing/layouts/app');

        // appAdminTemplate
        view()->share('appSuperadmin', 'superadmin/layouts/app');
    }
}