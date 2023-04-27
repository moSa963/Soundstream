<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdatePlaylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_new_playlist(): void
    {
        $playlist = Playlist::factory()->create();

        Sanctum::actingAs($playlist->user);

        $response = $this->post("api/playlists/{$playlist->id}", [
            "title" => "newTitle",
            "description" => "newDescription",
        ]);

        $response->assertSuccessful();
        $response->assertJsonPath("data.title", "newTitle");
        $response->assertJsonPath("data.description", "newDescription");
    }
}
