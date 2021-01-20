<?php

namespace Zareismail\NovaLocation\Nova\Fields;
 
use GeneaLabs\NovaMapMarkerField\MapMarker as Field;
use Zareismail\NovaLocation\Nova\Map;

class MapMarker extends Field
{   
    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|callable|null  $attribute
     * @param  callable|null  $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this
            ->searchProvider(Map::option('provider') ?? 'esri')
            ->searchProviderKey(Map::option('key') ?? '')->defaultZoom(18)
            ->latitude('latitude')
            ->longitude('longitude')
            ->defaultLatitude(41.823611)
            ->defaultLongitude(-71.422222) 
            ->centerCircle(50, 'red', 1, .5);
    }
}
