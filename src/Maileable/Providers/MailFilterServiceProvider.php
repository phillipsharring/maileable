<?php

namespace Maileable\Providers;

use Maileable\Mail\Filters\Filter;
use Maileable\Console\Commands\MakeMailFilter;
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
        if ($this->app->runningInConsole()) {
            $this->commands([
                MailFilterMakeCommand::class,
            ]);
        }

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
        $this->app->bind(Filter::class, function($app) {
            return new Filter(config('maileable'));
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
