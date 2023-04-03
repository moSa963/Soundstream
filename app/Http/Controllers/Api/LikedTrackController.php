<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackResource;
use App\Models\LikedTrack;
use App\Models\Track;
use Illuminate\Http\Request;

class LikedTrackController extends Controller
{
    public function index(Request $request)
    {
        $tracks = $request->user()->liked_tracks()->simplePaginate(10);
        
        return TrackResource::collection($tracks);
    }

    public function store(Request $request, Track $track)
    {
        LikedTrack::firstOrCreate([
            'user_id' => $request->user()->id,
            'track_id' => $track->id,
        ]);

        return response()->noContent();
    }

    public function destroy(Request $request, Track $track)
    {
        LikedTrack::where('user_id', $request->user()->id)
            ->where('track_id', $track->id)
            ->delete();

        return response()->noContent();
    }
}
