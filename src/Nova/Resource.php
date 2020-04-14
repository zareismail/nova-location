<?php

namespace Zareismail\NovaLocation\Nova;
 
use Laravel\Nova\Http\Requests\NovaRequest; 
use Laravel\Nova\Resource as NovaResource;
use Illuminate\Http\Request;    
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text; 


abstract class Resource extends NovaResource
{ 
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Zareismail\Location\Location';

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
        $belongsToField = $this->when(static::belongsTo(), function() { 
            return static::belongsTo()->sortable()->required()->rules('required');
        });

        return[
            ID::make(__("ID"), 'id')->sortable(),

            $this->when($request->editing && $belongsToField, $belongsToField),  

            Text::make(__("Name"), 'name')
                ->sortable()
                ->required()
                ->rules('required'), 

            $this->when(! $request->editing && $belongsToField, $belongsToField),   
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
        return $query->where($query->qualifyColumn('resource'), static::class);
    } 
}
