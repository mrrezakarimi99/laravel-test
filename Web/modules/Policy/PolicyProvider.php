<?php

namespace Modules\Policy;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PolicyProvider extends ServiceProvider
{

    /**
     * @var string
     */
    private string $moduleName = 'Policy';

    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    private string $moduleNamespace = 'Modules\Policy\Http\Controllers';


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
        $this->loadMigrationsFrom($this->modulePath($this->moduleName , '/Database/migrations'));
        $this->mapApiRoutes();
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
            ->namespace($this->moduleNamespace)
            ->group($this->modulePath($this->moduleName , '/Routes/api.php'));
    }

    /**
     * @param $module
     * @param $path
     * @return string
     */
    protected function modulePath($module, $path): string
    {
        return base_path('modules/' . $module . $path);
    }

}
