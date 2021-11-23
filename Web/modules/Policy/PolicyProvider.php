<?php

namespace Modules\Policy;

use Illuminate\Support\ServiceProvider;

class PolicyProvider extends ServiceProvider
{

    private $moduleName = 'Policy';
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
        $this->loadMigrationsFrom('modules/' . $this->moduleName . '/Database/migrations');
    }
}
