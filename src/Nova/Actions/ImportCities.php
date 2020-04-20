<?php

namespace Zareismail\NovaLocation\Nova\Actions; 

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ImportCities extends Import
{    
    public function resource(): string
    {
        return "Zareismail\\NovaLocation\\Nova\\City";
    }

    public function filterInsertions(Collection $insertions, Model $model) : Collection
    {
        $insertion = $insertions->where("location_id", data_get($model, 'detail.location_id'))->first();
 
		return collect($insertion['citites'] ?? [])->map(function($city, $index) {
            unset($city['alias']);

			return array_merge($city, [ 
				'detail' => json_encode([
	    			"location_id" => $index
	    		])
			]);
		}); 
    }

    public function loadCountry(Model $model) : Model
    {
    	return $model->load('location')->location;
    }
}
