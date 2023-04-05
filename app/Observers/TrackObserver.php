<?php

namespace App\Observers;

use App\Models\Track;
use Illuminate\Support\Facades\Storage;

class TrackObserver
{
    /**
     * Handle the Track "deleted" event.
     */
    public function deleted(Track $track): void
    {
        Storage::delete("tracks/{$track->location}");
        $track->photo && Storage::delete("track_photo/{$track->photo}");
    }
}
