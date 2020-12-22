<?php 
namespace Zareismail\NovaLocation;
  
use Zareismail\NovaLocation\Models\Location;

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
    
    public function province()
    {
        return $this->locatable(__FUNCTION__);
    }   

    public function city()
    {
        return $this->locatable(__FUNCTION__);
    } 

    public function zone()
    {
        return $this->locatable(__FUNCTION__);
    } 
}