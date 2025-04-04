<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\Novel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChapterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Novel $novel): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chapter $chapter): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Novel $novel): bool
    {
        return $user->id === $novel->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chapter $chapter): bool
    {
        return $user->id === $chapter->novel->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chapter $chapter): bool
    {
        return $user->id === $chapter->novel->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chapter $chapter): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chapter $chapter): bool
    {
        return false;
    }
}
