<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use App\Models\TrackHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StreamTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_stream_a_track(): void
    {
        $track = Track::factory()->create();
        
        Sanctum::actingAs($track->user);

        $response = $this->get("api/tracks/{$track->id}/stream");

        $response->assertOk();

        $track->delete();
    }

    public function test_a_new_stream_history_is_added(): void
    {
        $track = Track::factory()->create();
        
        Sanctum::actingAs($track->user);

        $response = $this->get("api/tracks/{$track->id}/stream");

        $trackHistory = TrackHistory::where("user_id", $track->user->id)
                            ->where("track_id", $track->id)
                            ->first();

        $this->assertTrue($trackHistory != null);
        $this->assertTrue($trackHistory->play_count == 1);

        $track->delete();
    }

    
    public function test_a_stream_history_is_updated(): void
    {
        $trackHistory = TrackHistory::factory()->create();
        
        Sanctum::actingAs($trackHistory->user);

        $response = $this->get("api/tracks/{$trackHistory->track->id}/stream");

        $trackHistory = TrackHistory::where("user_id", $trackHistory->user->id)
                            ->where("track_id", $trackHistory->track->id)
                            ->first();

        $this->assertTrue($trackHistory != null);
        $this->assertTrue($trackHistory->play_count == 2);

        $trackHistory->track->delete();
    }
}
