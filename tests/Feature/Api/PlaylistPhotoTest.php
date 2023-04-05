<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PlaylistPhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_playlists_photo(): void
    {
        $playlist = Playlist::factory()->create();

        Sanctum::actingAs($playlist->user);

        $response = $this->post("api/playlists/{$playlist->id}/photo", [
            "photo" => UploadedFile::fake()->image("playlistImage.png"),
        ]);

        $response->assertSuccessful();
        
        $playlist = Playlist::find($playlist->id);

        Storage::assertExists("playlist_photo/{$playlist->photo}");

        $playlist->delete();

        Storage::assertMissing("playlist_photo/{$playlist->photo}");
    }
}
