<?php namespace App\Bootstrap;

use Illuminate\Log\Writer;
use Monolog\Handler\ChromePHPHandler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\ConfigureLogging as BaseConfigureLogging;

class ConfigureLogging extends BaseConfigureLogging {

    /**
     * Custom Monolog handler that I realy want.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  \Illuminate\Log\Writer  $log
     * @return void
     */
    protected function configureCustomHandler(Application $app, Writer $log)
    {
        $log->getMonolog()->pushHandler(new ChromePHPHandler());

        // May be I wanna log to file by daily too.
        $log->useDailyFiles($app->storagePath().'/logs/laravel.log', 5);
    }

}