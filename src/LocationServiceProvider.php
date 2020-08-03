<?php

namespace Asorasoft\Location;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // published files
        $this->publishes([
            __DIR__ . '/migrations' => base_path('database/migrations'),
            __DIR__ . '/models' => base_path('app/Models'),
            __DIR__ . '/Commands' => base_path('app/Console/Commands')
        ]);
    }
}
