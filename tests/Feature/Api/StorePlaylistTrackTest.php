<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\PlaylistTrack;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StorePlaylistTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_a_track_to_playlist(): void
    {
        $track = Track::factory()->create();
        $playlist = Playlist::factory()->create();
        
        Sanctum::actingAs($playlist->user);

        $response = $this->post("api/playlists/{$playlist->id}/tracks/{$track->id}");

        $response->assertSuccessful();
        $this->assertTrue(PlaylistTrack::where("playlist_id", $playlist->id)->where("track_id", $track->id)->exists());
    
        Storage::delete("tracks/{$track->location}");
    }

    public function test_user_can_not_add_a_track_to_others_playlist(): void
    {
        $track = Track::factory()->create();
        $playlist = Playlist::factory()->create();
        
        Sanctum::actingAs($track->user);

        $response = $this->post("api/playlists/{$playlist->id}/tracks/{$track->id}");

        $response->assertForbidden();
        $this->assertTrue(!PlaylistTrack::where("playlist_id", $playlist->id)->where("track_id", $track->id)->exists());
    
        Storage::delete("tracks/{$track->location}");
    }
}
