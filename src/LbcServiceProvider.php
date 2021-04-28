<?php


namespace MasterDmx\LbcArchitecture;

use Illuminate\Support\ServiceProvider;

class LbcServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        // Публикация конфига
        $this->publishes([__DIR__.'/../config/lbc.php' => config_path('lbc.php')], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \MasterDmx\LbcArchitecture\Console\LbcInstallCommand::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/lbc.php', 'lbc'
        );
    }
}
