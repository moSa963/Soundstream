<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use App\Models\TrackLyrics;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreTrackLyricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_lyrics(): void
    {
        $track = Track::factory()->create();
        
        Sanctum::actingAs($track->user);

        $data = [
            'lyrics' => "this is some lyrics",
            'timestamps' => "0,25,100,150,1200,",
        ];

        $response = $this->post("api/lyrics/tracks/{$track->id}", $data);

        $response->assertSuccessful();
        $this->assertTrue(TrackLyrics::where("track_id", $track->id)->exists());
    
        Storage::delete("tracks/{$track->location}");
    }

    public function test_user_can_not_store_lyrics_with_wrong_timestamps_format(): void
    {
        $track = Track::factory()->create();
        
        Sanctum::actingAs($track->user);

        $data = [
            'lyrics' => "this is some lyrics",
            'timestamps' => "0,25,10,,0,150,1200,",
        ];

        $response = $this->postJson("api/lyrics/tracks/{$track->id}", $data);

        $response->assertUnprocessable();
        $this->assertFalse(TrackLyrics::where("track_id", $track->id)->exists());
    
        Storage::delete("tracks/{$track->location}");
    }
}
