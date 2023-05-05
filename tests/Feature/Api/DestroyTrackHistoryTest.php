<?php

namespace Tests\Feature\Api;

use App\Models\TrackHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyTrackHistoryTest extends TestCase
{
    use RefreshDatabase;


    public function test_example(): void
    {
        $trackHistory = TrackHistory::factory()->create();

        Sanctum::actingAs($trackHistory->user);

        $response = $this->delete("api/history/tracks/{$trackHistory->track->id}");

        $response->assertNoContent();

        $this->assertFalse(TrackHistory::where("user_id", $trackHistory->user->id)->where("track_id", $trackHistory->track->id)->exists());

        $trackHistory->track->delete();
    }
}
