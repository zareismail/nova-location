<?php

namespace Zareismail\NovaLocation\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany; 
use Zareismail\Fields\BelongsTo; 
    

class City extends Resource
{   
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaLocation\Models\City::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    { 
        return array_merge(parent::fields($request), [
            HasMany::make(__('Zones'), 'locations', Zone::class), 
        ]);
    }

    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    public function belongsTo()
    { 
        return BelongsTo::make(__("Province"), "location", Province::class)->rules('required');
    }
}
