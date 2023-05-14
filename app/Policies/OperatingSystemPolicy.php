<?php

namespace App\Policies;

use App\Models\OperatingSystem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OperatingSystemPolicy
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
        return $user->hasRole(['admin', 'super_admin']) ?
            Response::allow()
            : Response::deny('You do not have the right role.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingSystem  $operatingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OperatingSystem $operatingSystem)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingSystem  $operatingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OperatingSystem $operatingSystem)
    {
        return ($user->id == $operatingSystem->user_id && $user->hasRole('admin')) ||
            $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You are not the creator of this operatingSystem.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingSystem  $operatingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OperatingSystem $operatingSystem)
    {
        return ($user->id == $operatingSystem->user_id && $user->hasRole('admin')) ||
            $user->hasRole('super_admin') ?
            Response::allow()
            : Response::deny('You are not the creator of this operatingSystem.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingSystem  $operatingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OperatingSystem $operatingSystem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OperatingSystem  $operatingSystem
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OperatingSystem $operatingSystem)
    {
        //
    }
}
