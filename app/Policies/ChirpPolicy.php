<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Support\Facades\Auth;


class ChirpPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chirp $chirpe): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirpe): bool
    {
        return $chirpe->user()->is($user);
        // return $user->id === $chirp->user_id
        // ? Response::allow()
        // : Response::deny('You do not own this post.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chirp $chirpe): bool
    {
        return $this->update($user, $chirpe);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chirp $chirpe): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chirp $chirpe): bool
    {
        //
    }
}
