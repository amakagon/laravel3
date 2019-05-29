<?php namespace Rem\BillingClient\Laravel;

use Rem\BillingClient\BillingClient;
use Rem\BillingClient\Contract\BillingClientContract;
use Illuminate\Support\ServiceProvider;

/**
 * Class BillingClientProvider
 * @package Rem\BillingClient\Laravel
 * @codeCoverageIgnore
 */
class BillingClientProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app['config']->get('client.billing');
        if ($config) {
            $this->app->instance('BillingClient', new BillingClient(
                $config,
                $this->app['log']
            ));
            $this->app->bind(BillingClientContract::class, 'BillingClient');
        }
    }

    public function provides()
    {
        return [
            'BillingClient',
        ];
    }
}
