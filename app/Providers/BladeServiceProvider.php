<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('user_can',function ($expression){
            $expression = str_replace('"','',$expression);
            $department =( explode('-',$expression)[0]);
            $action = (explode('-',$expression)[1] ?? null);
            return "<?php if (auth()->check() and canDo(auth()->id(),'$department','$action')) : ?>";
        });
        Blade::directive('end_user_can',function ($expression){
            return '<?php endif ?>';
        });
    }
}
