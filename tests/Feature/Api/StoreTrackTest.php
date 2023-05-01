<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreTrackTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_add_new_track(): void
    {
        $user = User::factory()->create();

        $playlist = Playlist::factory()->create([
            "user_id" => $user->id,
            "album" => true,
        ]);

        Sanctum::actingAs($user);

        $response = $this->post("api/tracks/albums/{$playlist->id}", [
            "title" => "test title",
            "track" => UploadedFile::fake()->create("testfile", 10, "audio/mp3"),
        ]);

        $response->assertCreated();

        $track = $user->tracks()->first();

        $this->assertTrue($track != null);
        $this->assertTrue(Storage::exists("tracks/{$track->location}"));
        Storage::delete("tracks/{$track->location}");
    }

    public function test_user_can_not_add_new_file_that_is_not_audio(): void
    {
        $user = User::factory()->create();

        $playlist = Playlist::factory()->create([
            "user_id" => $user->id,
            "album" => true,
        ]);

        Sanctum::actingAs($user);

        $response = $this->post("api/tracks/albums/{$playlist->id}", [
            "title" => "test title",
            "track" => UploadedFile::fake()->image("imageTest"),
        ]);

        $response->assertRedirect();

        $track = $user->tracks()->first();

        $this->assertTrue($track == null);
    }
}
