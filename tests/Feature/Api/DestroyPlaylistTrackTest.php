<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\PlaylistTrack;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyPlaylistTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_remove_a_track_for_his_playlist(): void
    {
        $track = Track::factory()->create();
        $playlist = Playlist::factory()->create();

        $pt = PlaylistTrack::create([
            "track_id" => $track->id,
            "playlist_id" => $playlist->id,
        ]);

        Sanctum::actingAs($playlist->user);

        $response = $this->delete("api/playlists/{$playlist->id}/tracks/{$track->id}");

        $response->assertSuccessful();

        $this->assertTrue(!PlaylistTrack::where("id", $pt->id)->exists());
    }
}
