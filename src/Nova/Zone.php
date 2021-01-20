<?php

namespace Zareismail\NovaLocation\Nova;

use Illuminate\Http\Request;
use Zareismail\Fields\BelongsTo;  
    

class Zone extends Resource
{   
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaLocation\Models\Zone::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {  
        return array_merge(parent::fields($request), [ 
            Fields\MapMarker::make('Google Location', 'google_location'), 
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
