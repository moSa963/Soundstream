<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlaylistRequest;
use App\Http\Resources\PlaylistResource;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request) 
    {
        $albums = $request->user()->albums()->simplePaginate($request->query("count", 100))->withQueryString();

        return PlaylistResource::collection($albums);
    }

    public function store(StorePlaylistRequest $request)
    {
        $playlist = $request->store($request->user(), true);

        return new PlaylistResource($playlist);
    }
}
