<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Submission;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Submission $submission)
    {
        return $user->id === $submission->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return true; // Semua user yang sudah login bisa membuat submission
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Submission $submission)
    {
        return $user->id === $submission->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Submission $submission)
    {
        return $user->id === $submission->user_id;
    }
}