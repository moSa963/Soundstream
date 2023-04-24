<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlaylistRequest;
use App\Http\Resources\PlaylistResource;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        $playlists = $request->user()->playlists()->get();

        return PlaylistResource::collection($playlists);
    }

    public function show(Request $request, Playlist $playlist)
    {   
        $this->authorize("view", $playlist);

        return new PlaylistResource($playlist);
    }

    public function store(StorePlaylistRequest $request)
    {   
        $playlist = $request->store($request->user());

        return new PlaylistResource($playlist);
    }

    public function destroy(Request $request, Playlist $playlist)
    {
        $this->authorize("delete", $playlist);

        $playlist->delete();

        return response()->noContent();
    }
}
