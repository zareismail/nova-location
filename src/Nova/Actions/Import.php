<?php

namespace Zareismail\NovaLocation\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Zareismail\NovaLocation\Location;

abstract class Import extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    { 
        $country = $this->loadCountry($model = $models->first());
        $json = collect($this->requireJson($country));
        $locations = Location::whereResource($this->resource())->get()->map->name;  

        $insertions = $this->filterInsertions($json, $model)->reject(function($insertion) use ($locations) { 
        	return $locations->contains($insertion['name']);
        });

        Location::insert($insertions->map(function($insertion) use ($model) {  
            $insertion['location_id'] = $model->id;
            $insertion['resource'] = $this->resource();

            return $insertion;
        })->all()); 
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [ 
        ];
    }

    public function requireJson($country)
    {
    	$file = mb_strtolower($country->iso);
    	$path= dirname(dirname(dirname(__DIR__)))."/resources/{$file}.json";

    	if(file_exists($path)) {
    		return json_decode(file_get_contents($path), true);
    	}

    	throw new \Illuminate\Contracts\Filesystem\FileNotFoundException;
    }

    abstract public function loadCountry(Model $model) : Model;
    abstract public function filterInsertions(Collection $insertions, Model $model) : Collection;
}
