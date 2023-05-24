<?php

namespace Georuler\Sabangnet;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        $this->publishes([
            __DIR__ => app_path('../packages'),
        ], 'sabangnet');

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
