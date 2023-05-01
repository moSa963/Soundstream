<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreAlbumTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_new_album(): void
    {
        $user = User::factory()->create();

        $playlist = Playlist::factory()->makeOne();

        Sanctum::actingAs($user);

        $response = $this->post('api/albums', $playlist->toArray());

        $response->assertCreated();
        $response->assertJsonPath("data.title", $playlist->title);
        $response->assertJsonPath("data.album", true);
        $response->assertJsonPath("data.user.username", $user->username);
    }
}
