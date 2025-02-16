<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    public function before(?User $user, $ability) {
        if ($user?->is_admin) {
            return Response::allow();
        }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): Response
    {
        return $user->id === $listing->by_user_id
            ? Response::allow()
            : Response::deny('You do not own this listing.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): Response
    {
        return $user->id === $listing->by_user_id
            ? Response::allow()
            : Response::deny('You do not own this listing.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): Response
    {
        return $user->id === $listing->by_user_id
            ? Response::allow()
            : Response::deny('You do not own this listing.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): Response
    {
        return $user->id === $listing->by_user_id
            ? Response::allow()
            : Response::deny('You do not own this listing.');
    }
}
