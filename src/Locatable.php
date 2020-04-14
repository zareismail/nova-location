<?php 
namespace Zareismail\NovaLocation;
 
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Nova;

trait Locatable 
{     
    public function locations()
    {
        return $this->morphToMany(Location::class, 'locatable', 'locatables');
    } 

    protected function locatable(string $locatable)
    {
        return $this->belongsTo(Location::class, "{$locatable}_id");
    } 

    public function location()
    {
        return $this->locatable(__FUNCTION__);
    } 

    public function country()
    {
        return $this->locatable(__FUNCTION__);
    } 
    
    public function state()
    {
        return $this->locatable(__FUNCTION__);
    }  
    public function county()
    {
        return $this->locatable(__FUNCTION__);
    }  

    public function city()
    {
        return $this->locatable(__FUNCTION__);
    } 

    public function settlement()
    {
        return $this->locatable(__FUNCTION__);
    } 
}