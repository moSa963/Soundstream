<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrackHistoryResource;
use App\Models\Track;
use App\Models\TrackHistory;
use Illuminate\Http\Request;

class TrackHistoryController extends Controller
{
    public function index(Request $request)
    {
        $tracksHistory = $request->user()->tracks_history()->with("track")->simplePaginate(10);

        return TrackHistoryResource::collection($tracksHistory);
    }

    public function destroy(Request $request, Track $track)
    {
        TrackHistory::where("user_id", $request->user()->id)
            ->where("track_id", $track->id)
            ->delete();

        return response()->noContent();
    }
}
