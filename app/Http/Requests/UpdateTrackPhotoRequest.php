<?php

namespace App\Http\Requests;

use App\Models\Track;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateTrackPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function update(Track $track): void
    {
        $path = $this->file("photo")->store("track_photo", 'local');

        abort_if(!$path, 400, "Couldn't save the photo");

        if ($track->photo != null)
        {
            Storage::delete($track->photo);
        }

        $track->update([
            "photo" => explode('/', $path, 2)[1],
        ]);
    }

    public function rules(): array
    {
        return [
            "photo" => ["required", "image"],
        ];
    }
}
