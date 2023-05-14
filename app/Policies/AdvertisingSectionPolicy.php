<?php

namespace App\Policies;

use App\Models\AdvertisingSection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class AdvertisingSectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingSection  $advertisingSection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AdvertisingSection $advertisingSection)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You do not have the right role.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingSection  $advertisingSection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AdvertisingSection $advertisingSection)
    {
        return $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You do not have the right role.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingSection  $advertisingSection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AdvertisingSection $advertisingSection)
    {
        return $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You do not have the right role.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingSection  $advertisingSection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AdvertisingSection $advertisingSection)
    {
        return $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You do not have the right role.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingSection  $advertisingSection
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AdvertisingSection $advertisingSection)
    {
        return $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You do not have the right role.');
    }
}
