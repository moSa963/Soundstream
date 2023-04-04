<?php

namespace App\Policies;

use App\Models\Track;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TrackPolicy
{

    public function delete(User $user, Track $track): bool
    {
        return $user->id == $track->user_id;
    }

    public function show(User $user, Track $track): bool
    {
        return true;
    }
}
