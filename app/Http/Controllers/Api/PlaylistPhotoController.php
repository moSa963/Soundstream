<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePlaylistPhotoRequest;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistPhotoController extends Controller
{
    
    public function index(Request $request, Playlist $playlist)
    {
        if($playlist->photo != null)
        {
            return Storage::response("playlist_photo/{$playlist->photo}");
        }

        return response()->noContent();
    }

    public function update(UpdatePlaylistPhotoRequest $request, Playlist $playlist)
    {
        $this->authorize("update", $playlist);

        $request->update($playlist);

        return response()->noContent();
    }

    public function destroy(Request $request, Playlist $playlist)
    {
        $this->authorize("delete", $playlist);

        if ($playlist->photo != null)
        {
            Storage::delete($playlist->photo);
        }

        $playlist->update([ "photo" => null ]);

        return response()->noContent();
    }
}
