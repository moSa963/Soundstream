<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LikedPlaylist;
use App\Models\Playlist;
use Illuminate\Http\Request;

class LikedPlaylistController extends Controller
{
    public function store(Request $request, Playlist $playlist)
    {
        $this->authorize("view", $playlist);
        
        LikedPlaylist::firstOrCreate([
            'user_id' => $request->user()->id,
            'playlist_id' => $playlist->id,
        ]);

        return response()->noContent();
    }

    public function destroy(Request $request, Playlist $playlist)
    {
        LikedPlaylist::where('user_id', $request->user()->id)
            ->where('playlist_id', $playlist->id)
            ->delete();

        return response()->noContent();
    }
}
