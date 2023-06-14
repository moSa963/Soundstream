<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_track_info(): void
    {
        $track = Track::factory()->create([ "explicit" => false ]);

        Sanctum::actingAs($track->user);

        $response = $this->post("api/tracks/{$track->id}", [
            "title" => "newTitle",
            "explicit" => true,
            "written_by" => "newWritten_by",
            "performed_by" => "newPerformed_by",
        ]);

        $response->assertSuccessful();
        $response->assertJsonPath("data.title", "newTitle");
        $response->assertJsonPath("data.explicit", true);
        $response->assertJsonPath("data.written_by", "newWritten_by");
        $response->assertJsonPath("data.performed_by", "newPerformed_by");


        $track->delete();
    }
}
