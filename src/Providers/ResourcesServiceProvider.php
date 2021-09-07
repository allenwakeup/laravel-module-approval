<?php

namespace Goodcatch\Modules\Approval\Providers;

use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Collection;
use Nwidart\Modules\Json;

class ResourcesServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot ()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register ()
    {

        $this->registerViews ();
    }

    public function registerViews ()
    {
        if ($this->app->runningInConsole ()) {
            $src = __DIR__ . '/../..';
            $this->publishes ([
                $src . '/resources/js' =>  resource_path('js'),
            ], 'laravel-modules');
        }
    }
}
