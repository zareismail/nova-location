<?php

namespace Zareismail\NovaLocation\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;  
use Armincms\Tools\ToolbarAction\Action;
use Laravel\Nova\Fields\Boolean;
use Zareismail\NovaLocation\Nova\Country;
use Zareismail\NovaLocation\Location;
use Laravel\Nova\Nova;

class ImportCountries extends Action
{  
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    { 
        $json = file_get_contents(
            dirname(dirname(dirname(__DIR__)))."/resources/countries.json"
        );

        $shortnames = Location::whereResource(Country::class)->get()->pluck("shortname")->all();

        $insertions = collect(json_decode($json, true))->whereNotIn("shortname", $shortnames);

        Location::insert($insertions->map(function($insertion) use ($fields) {
            return [
                "iso" => $insertion['iso'],
                "resource" => Country::class,
                "active" => $insertion['iso'] == "IR" || boolval($fields->active),
            ];
        })->all()); 

        $keys = Location::whereResource(Country::class)->get()->pluck("id", "iso");

        (new Location)->translations()->insert($insertions->map(function($insertion) use ($keys) {
            return [
                "name" => $insertion['name'],
                "location_id" => $keys->get($insertion['iso']),
            ];
        })->all());

        option()->put("_countries_imported_", 1);

        return static::redirect(url(Nova::path().'/resources/countries'));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Boolean::make(__("Have be available"), 'active'),
        ];
    } 
}
