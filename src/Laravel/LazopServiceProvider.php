<?php

namespace Lazada\OpenPlatform\Laravel;

use Illuminate\Support\ServiceProvider;
use Lazada\OpenPlatform\Client;

class LazopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Laravel/config.php' => config_path('e-commerce.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('lazop-client', function ($app) {
            $config = $app['config'];
            $client = new Client($config->get('e-commerce.lazada.http_client', null));
            $client->setAppId($config->get('e-commerce.lazada.app_id'));
            $client->setAppSecret($config->get('e-commerce.lazada.app_secret'));
            $client->setAppName($config->get('e-commerce.lazada.app_name'));
            $client->setServiceLocale($config->get('e-commerce.lazada.api_locale'));
            if ($config->get('e-commerce.lazada.debug', false)) {
                $client->sandbox();
            } else {
                $client->production();
            }
            return $client;
        });
    }
}
