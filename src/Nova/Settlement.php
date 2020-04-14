<?php

namespace Zareismail\NovaLocation\Nova;

use Laravel\Nova\Fields\BelongsTo; 
    

class Settlement extends Resource
{   
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
