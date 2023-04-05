<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TrackPhotoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_update_tracks_photo(): void
    {
        $track = Track::factory()->create();

        Sanctum::actingAs($track->user);

        $response = $this->post("api/tracks/{$track->id}/photo", [
            "photo" => UploadedFile::fake()->image("trackImage.png"),
        ]);

        $response->assertSuccessful();
        
        $track = Track::find($track->id);

        Storage::assertExists("track_photo/{$track->photo}");

        $track->delete();

        Storage::assertMissing("track_photo/{$track->photo}");
    }
}
