<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                "username" => $this->user->username,
                "photo" => $this->user->photo,
            ],
            'title' => $this->title,
            'description' => $this->description,
            'album' => boolval($this->album),
            'created_at' => $this->created_at,
            'liked' => $request->user()->liked_playlists()->wherePivot("playlist_id", $this->id)->exists(),
            'tracks_count' => $this->whenCounted('playlists_tracks'),
            'private' => boolval($this->private),
            'image' => $this->photo,
        ];
    }
}
