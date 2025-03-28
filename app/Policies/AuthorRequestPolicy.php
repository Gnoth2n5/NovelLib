<?php

namespace App\Policies;

use App\Models\AuthorRequest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AuthorRequest $authorRequest): bool
    {
        return $user->id === $authorRequest->user_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return !$user->hasRole('author') && !$user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AuthorRequest $authorRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AuthorRequest $authorRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AuthorRequest $authorRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AuthorRequest $authorRequest): bool
    {
        return false;
    }

    public function approve(User $user, AuthorRequest $authorRequest): bool
    {
        return $user->hasRole('admin');
    }

    public function reject(User $user, AuthorRequest $authorRequest): bool
    {
        return $user->hasRole('admin');
    }
}
