<?php

namespace Zareismail\NovaLocation\Nova\Actions; 

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ImportStates extends Import
{    
    public function resource(): string
    {
        return "Zareismail\\Location\\Nova\\State";
    }

    public function filterInsertions(Collection $insertions, Model $model) : Collection
    {
    	return $insertions->map(function($insertion) {    
            $insertion['detail'] = json_encode([
                'location_id' => $insertion['location_id']
            ]);

    		unset($insertion['citites']); 
            unset($insertion['location_id']); 
            unset($insertion['alias']); 

    		return $insertion;
    	});
    }

    public function loadCountry(Model $model) : Model
    {
    	return $model;
    }
}
