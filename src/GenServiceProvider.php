<?php

namespace Gen;

use Illuminate\Support\ServiceProvider;

class GenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGenMigration();
    }

    /**
     * Register the gen:migration
     */
    private function registerGenMigration()
    {
        $this->app->singleton('command.gen', function ($app) {
            return $app['Gen\Commands\Migration'];
        });

        $this->commands('command.gen');
    }

}