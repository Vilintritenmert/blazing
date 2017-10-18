<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Vilintritenmert\SimpleCurrency;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
     protected $defer = true;

     
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SimpleCurrency::class, function ($app) {
            return new SimpleCurrency;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
     public function provides()
     {
         return [SimpleCurrency::class];
     }

}
