<?php

namespace Zareismail\NovaLocation\Nova;

use Illuminate\Http\Request;

class Country extends Resource
{   
    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    public function belongsTo()
    { 
    }

    /**
     * Get the actions available on the entity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // public function actions(Request $request)
    // {
    //     return [ 
    //         (new Actions\ImportStates)->canSee(function($request) {
    //             return $request->user()->can('import');
    //         })->onlyOnTableRow(),
    //     ];
    // }
}
