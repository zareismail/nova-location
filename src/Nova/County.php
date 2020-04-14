<?php

namespace Zareismail\NovaLocation\Nova;

use Laravel\Nova\Fields\BelongsTo; 
    

class County extends Resource
{   
    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    public function belongsTo()
    { 
        return BelongsTo::make(__("State"), "location", State::class) 
            ->searchable()
            ->rules('required');
    }
}
