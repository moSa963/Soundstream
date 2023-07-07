<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserPlaylistController extends Controller
{
    public function index(Request $request, $username)
    {
        $user = User::where("username", $username)->firstOrFail();

        $playlists = $user->owned_playlists()->where("album", false)->where("private", false)->simplePaginate($request->query("count", 100))->withQueryString();

        return PlaylistResource::collection($playlists);
    }
}
