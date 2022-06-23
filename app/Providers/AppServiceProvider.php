<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        if (file_exists(base_path('config/itconfiguration.php'))) {
            Schema::defaultStringLength(config('itconfiguration.SchemadefaultStringLength'));
            if (config('itconfiguration.ForeignKeyConstraints')) {
                Schema::enableForeignKeyConstraints();
            } else {
                Schema::disableForeignKeyConstraints();
            }
        }
        Paginator::useBootstrap();


        $this->registerBladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    private function registerBladeDirectives()
    {
        Blade::directive('receptionist', function ($expression) {
            return auth()->user()->isReceptionist();
        });

        Blade::directive('doctor', function ($expression) {
            return auth()->user()->isDoctor();
        });

        Blade::directive('accountant', function ($expression) {
            return auth()->user()->isAccountant();
        });
    }
}
