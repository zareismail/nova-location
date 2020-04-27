<?php

namespace Zareismail\NovaLocation;
 
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\ServiceProvider; 
use Laravel\Nova\Nova as LaravelNova;
use Illuminate\Support\Facades\Gate;

class LocationServiceProvider extends ServiceProvider
{  
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        if($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');

        LaravelNova::serving([$this, 'servingNova']);   

        Gate::policy(Location::class, Policies\Location::class); 
    } 

    /**
     * Serving the Laravel Nova Application
     * 
     */
    public function servingNova()
    {
        LaravelNova::resources([
            Nova\Location::class,
            Nova\Country::class,
            Nova\State::class, 
            Nova\City::class,
            Nova\Settlement::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Auth blueprint
        Blueprint::macro('location', function($name = 'location') {
            return $this->foreignId("{$name}_id")->constrained('locations');
        });
    }
}
