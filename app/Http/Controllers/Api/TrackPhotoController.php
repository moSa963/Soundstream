<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTrackPhotoRequest;
use App\Http\Resources\TrackResource;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackPhotoController extends Controller
{

    public function index(Request $request, Track $track, string $key)
    {
        if($track->photo == $key)
        {
            return Storage::response("track_photo/{$track->photo}");
        }

        return response()->redirectTo("img/track.png");
    }

    public function update(UpdateTrackPhotoRequest $request, Track $track)
    {
        $this->authorize("update", $track);

        $request->update($track);

        return new TrackResource($track);
    }

    public function destroy(Request $request, Track $track)
    {
        $this->authorize("delete", $track);

        if ($track->photo != null)
        {
            Storage::delete($track->photo);
        }

        $track->update([ "photo" => null ]);

        return response()->noContent();
    }
}
