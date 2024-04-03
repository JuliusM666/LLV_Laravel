<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class LocationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return False;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Location $location): bool
    {
        return False;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->isAdmin!=True ){
            return Response::deny("Sorry you can't create location");
        }
        return True;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Location $location)
    {

        if($user->isAdmin!=True || $location->user_id!=$user->id){
            return Response::deny("Sorry you can't update this location");
        }
        return True;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Location $location)
    {
       
        if($user->isAdmin!=True || $location->user_id!=$user->id){
            return Response::deny("Sorry you can't delete this location");
            
        }
        return True;
        
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Location $location): bool
    {
        return False;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Location $location): bool
    {
        return False;
    }
}
