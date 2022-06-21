<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    public const HOME = '/';
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapDoctorRoutes();
        $this->mapAccountantRoutes();
        $this->mapReceptionistRoutes();
        $this->oldRoutes(); 
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        include_once base_path('routes/configurations.php');

        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));

        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapDoctorRoutes()
    {
        Route::middleware(['web','auth','doctor','Lang'])
            ->namespace($this->namespace."\\Doctor")
            ->group(base_path('routes/doctor.php'));
    }

    protected function mapAccountantRoutes()
    {
        Route::middleware(['web','auth','accountant','Lang'])
            ->as('accountant.')
            ->prefix('accountant')
            ->namespace("")
            ->group(base_path('routes/accountant.php'));
    }

    protected function mapReceptionistRoutes()
    {
        Route::middleware(['web','auth','receptionist','Lang'])
            ->as('receptionist.')
            ->prefix('receptionist')
            ->namespace("")
            ->group(base_path('routes/receptionist.php'));
    }

    protected function oldRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/old.php'));
    }
}
