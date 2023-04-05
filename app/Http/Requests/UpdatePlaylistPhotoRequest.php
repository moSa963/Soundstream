<?php

namespace App\Http\Requests;

use App\Models\Playlist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdatePlaylistPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function update(Playlist $playlist): void
    {
        $path = $this->file("photo")->store("playlist_photo", 'local');

        if ($playlist->photo != null)
        {
            Storage::delete($playlist->photo);
        }

        $playlist->update([
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
