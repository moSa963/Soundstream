<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackResource;
use App\Models\LikedTrack;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class LikedTrackController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->user()->liked_tracks();
        
        //if username input exists just get the liked tracks that belong to that specific user
        if ($request->has("username"))
        {
            $user = User::where("username", $request->query("username"))->firstOrFail();
            $q = $q->where("tracks.user_id", $user->id);
        }

        $tracks = $q->simplePaginate($request->query("count", 100))->withQueryString();
        
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
