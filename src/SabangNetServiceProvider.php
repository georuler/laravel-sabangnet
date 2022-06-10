<?php

namespace Georuler\Sabangnet;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class SabangNetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ConfigRepository $configRepository)
    {
        $this->publishes([
            __DIR__  => $this->app . '/packages',
        ], 'lighthouse-config');

        //route add
        Route::middleware('api')
        ->prefix('api')
        ->group(__DIR__ . '/routes/api.php');

        //blade template path init
        view()->addNamespace('Xml', __DIR__.'/resources/views/xml');

        //config add
        app('config')->set('sabangnet', require __DIR__ . '/config/sabangnet.php');
    }
}
