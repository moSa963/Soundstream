<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrackRequest;
use App\Http\Resources\TrackResource;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    public function index(Request $request)
    {
        $tracks = $request->user()->tracks()->get();

        return TrackResource::collection($tracks);
    }

    public function show(Request $request, Track $track) 
    {
        return new TrackResource($track);
    }

    public function store(StoreTrackRequest $request, Playlist $playlist) 
    {
        $this->authorize("uploadTrack", $playlist);

        $track = $request->store();

        return new TrackResource($track);
    }

    public function destroy(Request $request, Track $track ) 
    {
        $this->authorize("delete", $track);
        
        $track->delete();
        
        return response()->noContent();
    }
}
