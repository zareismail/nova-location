<?php 

namespace Zareismail\NovaLocation;
 
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Nova;

class Location extends Model 
{ 
	public $timestamps 	= false; 
    
	protected $guarded 	= []; 

	protected $casts	= [
		'detail' => 'json'
	]; 

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {   
            $model->resource = Nova::resourceForKey(request()->route('resource')); 
        });
    }

    public function location()
    {
        return $this->belongsTo($this);
    } 
}