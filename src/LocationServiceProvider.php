<?php

namespace Zareismail\NovaLocation;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\ServiceProvider; 
use Laravel\Nova\Nova as LaravelNova;
use Illuminate\Support\Facades\Gate;

class LocationServiceProvider extends ServiceProvider implements DeferrableProvider
{   
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPolicies();
        $this->app->runningInConsole() ? $this->servingConsole() : $this->servingNova(); 
    } 

    /**
     * Register any policies.
     *
     * @return void
     */
    public function registerPolicies()
    { 
        Gate::policy(Models\Country::class, Policies\Location::class); 
        Gate::policy(Models\Province::class, Policies\Location::class); 
        Gate::policy(Models\City::class, Policies\Location::class); 
        Gate::policy(Models\Zone::class, Policies\Location::class); 
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function servingConsole()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // Auth blueprint
        Blueprint::macro('location', function($name = 'location') {
            return $this->foreignId("{$name}_id")->nullable()->constrained('locations');
        });
    }

    /**
     * Register any Nova services.
     *
     * @return void
     */
    public function servingNova()
    {
        LaravelNova::resources([ 
            Nova\Country::class,
            Nova\Province::class, 
            Nova\City::class,
            Nova\Zone::class,
            Nova\Map::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [
            \Illuminate\Console\Events\ArtisanStarting::class,
            \Laravel\Nova\Events\ServingNova::class,
        ];
    }
}
