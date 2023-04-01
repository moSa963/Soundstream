<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrackRequest;
use App\Http\Resources\TrackResource;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrackController extends Controller
{
    public function index(Request $request)
    {
        $tracks = $request->user()->tracks()->simplePaginate(10);

        return TrackResource::collection($tracks);
    }

    public function show(Request $request, Track $track) 
    {
        return new TrackResource($track);
    }

    public function store(StoreTrackRequest $request) 
    {
        $track = $request->store(Auth::user());

        return new TrackResource($track);
    }

    public function destroy(Request $request, Track $track ) 
    {
        $this->authorize("delete", $track);
        
        abort_if(!Storage::delete("tracks/{$track->location}"), 500, "Couldn't delete the file, please try again later");
        
        $track->delete();
        
        return response()->noContent();
    }
}
