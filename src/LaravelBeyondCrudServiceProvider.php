<?php


namespace MasterDmx\LbcArchitecture;

use Illuminate\Support\ServiceProvider;
use MasterDmx\LbcArchitecture\Console\ModelMakeCommand;

class LaravelBeyondCrudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/lbc_architecture.php' => config_path('lbc_architecture.php')
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/lbc_architecture.php', 'lbc_architecture'
        );
    }
}
