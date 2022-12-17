<?php

/**
 * @author Klayton R. Massango <klayton0304massango@gmail.com>
 * @license http://mit-license.org/
 * @link https://gitHub.com/Klayton258
 * @copyright Klayton Massango
 */

namespace Say7ama\MpesaSdk;

use Illuminate\Support\ServiceProvider;

class MpesaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/MpesaSdk.php', 'MpesaSdk');

        $this->publishes([
            __DIR__.'/config/MpesaSdk.php'=>config_path('MpesaSdk.php')
        ]);
    }

    public function register()
    {

    }
}
