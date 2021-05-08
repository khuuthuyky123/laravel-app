<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class ProfileProlicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        Log::info('user' . $user->id);
        // Log::info('model' . $model->id);
        //return (strval($user->role_id)=="4");
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function view(User $user, Profile $profile)
    {
        return (strval($user->role_id)=="4" || $user->email==$profile->email);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (strval($user->role_id)=="4");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function update(User $user, Profile $profile)
    {
        return (strval($user->role_id)=="4" || $user->email==$profile->email);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function delete(User $user, Profile $profile)
    {
        return (strval($user->role_id)=="4");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function restore(User $user, Profile $profile)
    {
        return (strval($user->role_id)=="4");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return mixed
     */
    public function forceDelete(User $user, Profile $profile)
    {
        return (strval($user->role_id)=="4");
    }
}
