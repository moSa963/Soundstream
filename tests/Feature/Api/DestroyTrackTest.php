<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyTrackTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_his_track(): void
    {
        $track = Track::factory()->create();

        Sanctum::actingAs($track->user);

        $this->assertTrue(Storage::exists("tracks/{$track->location}"));

        $response = $this->delete("api/tracks/{$track->id}");

        $response->assertSuccessful();

        $this->assertTrue(!Storage::exists("tracks/{$track->location}"));
    }
}
