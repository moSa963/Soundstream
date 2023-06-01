<?php

namespace Tests\Feature\Api;

use App\Models\LikedPlaylist;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreLikedPlaylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_a_playlist(): void
    {
        $user = User::factory()->create();
        $playlist = Playlist::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->post("api/likes/playlists/{$playlist->id}");

        $response->assertSuccessful();

        $this->assertTrue(LikedPlaylist::where("user_id", $user->id)->where("playlist_id", $playlist->id)->exists());
    }
}
