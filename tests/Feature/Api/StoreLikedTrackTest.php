<?php

namespace Tests\Feature\Api;

use App\Models\LikedTrack;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreLikedTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_a_track(): void
    {
        $user = User::factory()->create();
        $track = Track::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->post("api/likes/tracks/{$track->id}");

        $response->assertSuccessful();

        $this->assertTrue(LikedTrack::where("user_id", $user->id)->where("track_id", $track->id)->exists());

        Storage::delete("tracks/{$track->location}");
    }
}
