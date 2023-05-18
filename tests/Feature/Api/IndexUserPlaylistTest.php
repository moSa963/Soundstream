<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexUserPlaylistTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_get_a_list_of_other_user_playlists(): void
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        Playlist::factory(5)->create([ "user_id" => $user->id ]);
        Playlist::factory(4)->create([ "user_id" => $user2->id ]);

        Sanctum::actingAs($user);

        $response = $this->get("api/users/{$user2->username}/playlists");

        $response->assertSuccessful();

        $response->assertJsonCount(4, "data");
    }
}
