<?php

namespace Maileable\Providers;

use Maileable\Mail\Filters\Filter;
use Illuminate\Support\ServiceProvider;

class MailFilterServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/maileable.php' => config_path('maileable.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $config = config('maileable');

        $this->app->bind(Filter::class, function() {
            return new Filter($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Filter::class];
    }
}
