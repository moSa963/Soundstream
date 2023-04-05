<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTrackPhotoRequest;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrackPhotoController extends Controller
{

    public function index(Request $request, Track $track)
    {
        if($track->photo != null)
        {
            return Storage::response("track_photo/{$track->photo}");
        }

        return response()->noContent();
    }

    public function update(UpdateTrackPhotoRequest $request, Track $track)
    {
        $this->authorize("update", $track);

        $request->update($track);

        return response()->noContent();
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
