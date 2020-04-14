<?php

namespace Zareismail\NovaLocation\Nova; 

use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request; 

class State extends Resource
{   
    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    public function belongsTo()
    { 
        return BelongsTo::make(__("Country"), "location", Country::class)->rules('required');
    }

    /**
     * Get the actions available on the entity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [ 
            (new Actions\ImportCities)->canSee(function($request) {
                return $request->user()->can('import');
            })->onlyOnTableRow(),
        ];
    }
}
