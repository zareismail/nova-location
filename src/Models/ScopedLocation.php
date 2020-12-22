<?php 

namespace Zareismail\NovaLocation\Models;

use Laravel\Nova\Nova;

abstract class ScopedLocation extends Location
{  
    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function($query) { 
            return $query->resource((array) Nova::resourceForModel($query->getModel()));
        });
    }

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return Location::class;
    }  
}