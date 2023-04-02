<?php

namespace App\Policies;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlaylistPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Playlist $playlist): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Playlist $playlist): bool
    {
        return $user->id == $playlist->user_id;
    }

    public function update(User $user, Playlist $playlist): bool
    {
        return $user->id == $playlist->user_id;
    }
}
