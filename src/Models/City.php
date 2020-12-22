<?php 

namespace Zareismail\NovaLocation\Models; 

use Zareismail\Fields\Contracts\Cascade;

class City extends ScopedLocation implements Cascade
{
    /**
     * Query the parent resource.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Province::class, 'location_id');
    }    
}