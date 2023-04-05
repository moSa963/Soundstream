<?php

namespace App\Observers;

use App\Models\Playlist;
use Illuminate\Support\Facades\Storage;

class PlaylistObserver
{
    public function deleted(Playlist $playlist): void
    {
        $playlist->photo && Storage::delete("playlist_photo/{$playlist->photo}");
    }
}
