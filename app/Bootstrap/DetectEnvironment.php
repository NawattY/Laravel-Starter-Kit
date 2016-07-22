<?php namespace App\Bootstrap;

use Dotenv\Dotenv;
use InvalidArgumentException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\DetectEnvironment as BaseDetectEnvironment;

class DetectEnvironment extends BaseDetectEnvironment {

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $app->detectEnvironment(function() {
            $environments = array(
                'local' => array('*.dock'),
                'develop'    => array('laravel-starter-kit-dev.kiddeestudio.com'),
                'production' => array('laravel-starter-kit.kiddeestudio.com')
            );

            $hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : gethostname();
            foreach ($environments as $environment => $hosts) {
                foreach ((array) $hosts as $host) {
                    if (str_is($host, $hostname)) {
                        return $environment;
                    }
                }
            }

            return env('APP_ENV', 'production');
        });

        try {
            (new Dotenv($app['path.base'], $app->environmentFile() . '.' . $app->environment()))->load();
        } catch (InvalidArgumentException $e) {
            (new Dotenv($app['path.base'], $app->environmentFile()))->load();
        }
    }

}
