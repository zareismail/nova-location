<?php

namespace Zareismail\NovaLocation\Nova;
 
use Illuminate\Http\Request;   
use Laravel\Nova\Fields\{ID, Text}; 
use Laravel\Nova\Http\Requests\NovaRequest; 
use Laravel\Nova\Resource as NovaResource; 
use Armincms\Fields\{Targomaan, InteractsWithJsonTranslator}; 


abstract class Resource extends NovaResource
{ 
    use InteractsWithJsonTranslator;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
    ]; 

    /**
     * The json columns that should be searched.
     *
     * @var array
     */
    public static $searchJson = [
        'name'
    ]; 

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Locations';  

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {  
        return[
            ID::make(__("ID"), 'id')->sortable(),

            $this->when(static::belongsTo(), function() {
                return static::belongsTo()
                            ->withoutTrashed()
                            ->searchable()
                            ->sortable()
                            ->required()
                            ->rules('required');
            }), 

            Targomaan::make([
                Text::make(__("Name"), 'name')
                    ->sortable()
                    ->required()
                    ->rules('required'), 
            ]),

            Text::make('ISO', 'iso'),    
        ]; 
    } 

    /**
     * Get the realted resource field.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Nova\Fields\Field
     */
    abstract public function belongsTo();
 
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->resource(static::class);
    } 
}
