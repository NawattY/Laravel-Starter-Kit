<?php namespace App\Bootstrap;

use Dotenv;
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
        $app->detectEnvironment(function()
        {
            $environments = array(
                'local' => array('*.loc', 'localhost', '*.app'),
                'develop'    => array('demo*.kiddeestudio.com'),
                'staging'    => array('*staging*'),
                'production' => array('*weshareable.com')
            );

            $hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : gethostname();
            foreach ($environments as $environment => $hosts)
            {
                foreach ((array) $hosts as $host)
                {
                    if (str_is($host, $hostname))
                        return $environment;
                }

            }

            return env('APP_ENV', 'local');
        });

        try
        {
            Dotenv::load($app['path.base'], $app->environmentFile() . '.' . $app->environment());
        }
        catch (InvalidArgumentException $e)
        {
            Dotenv::load($app['path.base'], $app->environmentFile());
        }
    }

}