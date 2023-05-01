<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexAlbumTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_a_list_of_his_playlists(): void
    {
        $user = User::factory()->create();
        
        Playlist::factory(5)->create([ "user_id" => $user->id, "album" => true ]);
        Playlist::factory(5)->create([ "album" => true ]);

        Sanctum::actingAs($user);

        $response = $this->get('api/albums');

        $response->assertSuccessful();

        $response->assertJsonCount(5, "data");
    }
}
