<?php

namespace Tests\Feature\Api;

use App\Models\LikedPlaylist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyLikedPlaylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_unlike_a_playlist(): void
    {
        $like = LikedPlaylist::factory()->create();

        Sanctum::actingAs($like->user);

        $response = $this->delete("api/likes/playlists/{$like->playlist_id}");

        $response->assertSuccessful();

        $this->assertTrue(!LikedPlaylist::where("id", $like->id)->exists());
    }
}
