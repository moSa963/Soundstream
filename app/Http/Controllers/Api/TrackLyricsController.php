<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrackLyrics;
use App\Http\Requests\StoreTrackLyricsRequest;
use App\Http\Resources\TrackLyricsResource;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackLyricsController extends Controller
{
    public function show(Request $request, Track $track)
    {
        $this->authorize("update", $track);

        $lyrics = $track->lyrics;

        abort_if($lyrics == null, 404);

        return new TrackLyricsResource($lyrics);
    }

    public function store(StoreTrackLyricsRequest $request, Track $track)
    {
        $this->authorize("update", $track);

        $lyrics = $request->store($track);

        return new TrackLyricsResource($lyrics);
    }
}
