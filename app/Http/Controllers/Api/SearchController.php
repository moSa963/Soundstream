<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Http\Resources\TrackResource;
use App\Http\Resources\UserResource;
use App\Models\Playlist;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, string $key)
    {
        $tracks = Track::public_tracks()->where("tracks.title", "like", "%{$key}%")->take(10)->get();
        $albums = Playlist::where("album", true)->where("title", "like", "%{$key}%")->where("private", false)->take(10)->get();
        $playlists = Playlist::where("album", false)->where("title", "like", "%{$key}%")->where("private", false)->take(10)->get();
        $users = User::where("username", "like", "%{$key}%")->orWhere("name", "like", "%{$key}%")->take(10)->get();

        return response()->json([
            "data" => [
                "tracks" => TrackResource::collection($tracks),
                "albums" => PlaylistResource::collection($albums),
                "playlists" => PlaylistResource::collection($playlists),
                "users" => UserResource::collection($users),
            ],
        ]);
    }
}
