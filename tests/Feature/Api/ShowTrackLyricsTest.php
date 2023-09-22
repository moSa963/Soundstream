<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use App\Models\TrackLyrics;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowTrackLyricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_track_lyrics(): void
    {
        $track = Track::factory()->create();
        TrackLyrics::create([
            "track_id" => $track->id,
            'lyrics' => "this is some lyrics",
            'timestamps' => "0,25,100,150,1200",
        ]);

        Sanctum::actingAs($track->user);

        $response = $this->get("api/lyrics/tracks/{$track->id}");

        $response->assertSuccessful();
        $this->assertTrue(TrackLyrics::where("track_id", $track->id)->exists());

        Storage::delete("tracks/{$track->location}");
    }

    use RefreshDatabase;

    public function test_user_can_not_get_track_lyrics_that_does_not_exists(): void
    {
        $track = Track::factory()->create();

        Sanctum::actingAs($track->user);

        $response = $this->get("api/lyrics/tracks/{$track->id}");

        $response->assertNotFound();
        $this->assertFalse(TrackLyrics::where("track_id", $track->id)->exists());

        Storage::delete("tracks/{$track->location}");
    }
}
