<?php

namespace Asorasoft\Location;

use Asorasoft\Location\Commands\LocationCommand;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Asorasoft\Location\HelloController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // register commands
        $this->commands([
            LocationCommand::class,
        ]);

        // register routes
        include __DIR__ . '/routes.php';

        // published files
        $this->publishes([
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/models' => base_path('app/Models'),
        ]);
    }
}
