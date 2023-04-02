<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistTrack;
use App\Models\Track;
use Illuminate\Http\Request;

class PlaylistTrackController extends Controller
{
    public function store(Request $request, Playlist $playlist, Track $track)
    {
        $this->authorize("update", $playlist);

        PlaylistTrack::firstOrCreate([
            "playlist_id" => $playlist->id,
            "track_id" => $track->id,
        ]);

        return response()->noContent();
    }

    public function destroy(Request $request, Playlist $playlist, Track $track)
    {
        $this->authorize("update", $playlist);

        PlaylistTrack::where("playlist_id", $playlist->id)
            ->where("track_id", $track->id)
            ->delete();

        return response()->noContent();
    }
}
