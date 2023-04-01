<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                "username" => $this->user->username,
            ],
            'title' => $this->title,
            'duration' => $this->duration,
            'explicit' => $this->explicit,
            'written_by' => $this->written_by,
            'performed_by' => $this->performed_by,
        ];
    }
}
