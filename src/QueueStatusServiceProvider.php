<?php

namespace Tobya\Queuestatus;

use Illuminate\Support\ServiceProvider;

class QueueStatusServiceProvider extends ServiceProvider
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
    if ($this->app->runningInConsole()) {
        $this->commands([
            QueueCount::class,
            QueueStatusCommand::class,
        ]);
    }
    }
}
