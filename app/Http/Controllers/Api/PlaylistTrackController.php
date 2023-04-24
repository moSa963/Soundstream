<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackResource;
use App\Models\Playlist;
use App\Models\PlaylistTrack;
use App\Models\Track;
use Illuminate\Http\Request;

class PlaylistTrackController extends Controller
{
    public function index(Request $request, Playlist $playlist)
    {
        $this->authorize("view", $playlist);

        $tracks = $playlist->tracks()->get();

        return TrackResource::collection($tracks);
    }

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
