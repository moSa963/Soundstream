<?php

namespace App\Http\Requests;

use App\Models\Track;
use App\Models\TrackLyrics;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTrackLyricsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function store(Track $track): TrackLyrics
    {
        return TrackLyrics::updateOrCreate(
            [
                'track_id' => $track->id,
            ],
            [
                'lyrics' => $this->validated("lyrics"),
                'timestamps' => $this->validated("timestamps", ""),
            ]
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "lyrics" => ["required", "string"],
            "timestamps" => ["string", "regex:/^(([0-9]+(.[0-9])?),)+([0-9]+(.[0-9])?)+$/"],
        ];
    }
}
