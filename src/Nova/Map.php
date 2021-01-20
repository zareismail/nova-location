<?php

namespace Zareismail\NovaLocation\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{Text, Select};
use Zareismail\NovaContracts\Nova\BiosResource;

class Map extends BiosResource
{    
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    { 
        return [
            Select::make(__('Serach Provider'), static::prefix('provider'))
                ->options($this->serachProviders($request))
                ->required()
                ->rules('required')
                ->default('esri'),

            Text::make(__('Provider Key'), 'key')
                ->required()
                ->rules('required'), 
        ];
    } 

    /**
     * Returns configurable serach provider.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array           
     */
    public function serachProviders(Request $request)
    {
        return [
            'bing'  => 'Bing',
            'esri'  => 'Esri',
            'google'    => 'Google',
            'algolia'   => 'Algolia',
            'opencage'  => 'OpenCage',
            'locationid'=> 'LocationIQ',
            'openstreetmap' => 'OpenStreetMap',
        ];
    }
}
