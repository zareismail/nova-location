<?php

namespace Zareismail\NovaLocation\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo; 
use GeneaLabs\NovaMapMarkerField\MapMarker;
    

class Zone extends Resource
{   

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {  
        return array_merge(parent::fields($request), [ 
            MapMarker::make('Google Location', 'google_location')
                ->defaultZoom(18)
                ->latitude('latitude')
                ->longitude('longitude')
                ->defaultLatitude(41.823611)
                ->defaultLongitude(-71.422222)
                ->searchProvider('google')
                ->searchProviderKey('AIzaSyCiHD51ha_m3EeC6R0MYS6WYRQJxV8gHqw') 
                ->centerCircle(50, 'red', 1, .5), 
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
        return BelongsTo::make(__("City"), "location", City::class)->rules('required');
    }
}
