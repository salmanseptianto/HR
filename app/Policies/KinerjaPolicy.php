<?php

namespace App\Policies;

use App\Models\User;
use App\Models\kinerja;
use Illuminate\Auth\Access\Response;

class KinerjaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Allow all users to view any kinerja
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, kinerja $kinerja): bool
    {
        return true; // Allow all users to view a specific kinerja
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Allow all users to create kinerja
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, kinerja $kinerja): bool
    {
        return $user->id === $kinerja->user_id; // Allow only the owner to update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, kinerja $kinerja): bool
    {
        return $user->id === $kinerja->user_id; // Allow only the owner to delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, kinerja $kinerja): bool
    {
        return $user->id === $kinerja->user_id; // Allow only the owner to restore
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, kinerja $kinerja): bool
    {
        return $user->id === $kinerja->user_id; // Allow only the owner to force delete
    }
}
