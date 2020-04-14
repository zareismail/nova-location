<?php

namespace Zareismail\NovaLocation\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;
use Zareismail\NovaLocation\Location as Model;

class Location
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any policy roles.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function viewAny(Authenticatable $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\Location\Location  $location
     * @return mixed
     */
    public function view(Authenticatable $user, Model $location)
    {
        return true;
    }

    /**
     * Determine whether the user can create policy roles.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return mixed
     */
    public function create(Authenticatable $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\Location\Location  $location
     * @return mixed
     */
    public function update(Authenticatable $user, Model $location)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\Location\Location  $location
     * @return mixed
     */
    public function delete(Authenticatable $user, Model $location)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\Location\Location  $location
     * @return mixed
     */
    public function restore(Authenticatable $user, Model $location)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\Location\Location  $location
     * @return mixed
     */
    public function forceDelete(Authenticatable $user, Model $location)
    {
        return true;
    } 

    /**
     * Determine whether the user can add location to the location.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\Location\Location  $location
     * @return mixed
     */
    public function addLocation(Authenticatable $user, Model $location)
    {
        return false;
    } 
}
