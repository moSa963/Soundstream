<?php

namespace Tests\Feature\Api;

use App\Models\LikedTrack;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyLikedTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_unlike_a_track(): void
    {
        $like = LikedTrack::factory()->create();

        Sanctum::actingAs($like->user);

        $response = $this->delete("api/likes/tracks/{$like->track_id}");

        $response->assertSuccessful();

        $this->assertTrue(!LikedTrack::where("id", $like->id)->exists());

        Storage::delete("tracks/{$like->track->location}");
    }
}
