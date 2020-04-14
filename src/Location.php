<?php 

namespace Zareismail\NovaLocation;
 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Nova;

class Location extends Model 
{ 
    use SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['detail' => 'json']; 

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