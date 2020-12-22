<?php

namespace Zareismail\NovaLocation\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;

class Country extends Resource
{    
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaLocation\Models\Country::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    { 
        return array_merge(parent::fields($request), [
            HasMany::make(__('Provinces'), 'locations', Province::class), 
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
