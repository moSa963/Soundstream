<?php

namespace App\Http\Requests;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePlaylistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store(User $user, bool $album = false)
    {
        return Playlist::create([
            'user_id' => $user->id,
            'title' => $this->validated("title", "playlist ".($user->owned_playlists()->count() + 1)),
            'description' => $this->validated("description", ""),
            'album' => $album,
            'private' => $this->validated("private", true),
        ]);
    }

    public function update(Playlist $playlist)
    {
        return $playlist->update([
            'title' => $this->validated("title", $playlist->title),
            'description' => $this->validated("description", $playlist->description),
            'private' => $this->validated("private", $playlist->private),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'max:255'],
            'description' => ['string', 'max:800'],
            'private' => ['boolean'],
        ];
    }
}
