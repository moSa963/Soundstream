<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DestroyPlaylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_his_playlist(): void
    {
        $playlist = Playlist::factory()->create();

        Sanctum::actingAs($playlist->user);

        $response = $this->delete("api/playlists/{$playlist->id}");

        $response->assertSuccessful();
    }

    public function test_user_can_not_delete_others_playlist(): void
    {
        $playlist = Playlist::factory()->create();

        Sanctum::actingAs(User::factory()->create());

        $response = $this->delete("api/playlists/{$playlist->id}");

        $response->assertForbidden();
    }
}
