<?php

namespace Tests\Feature\Api;

use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexTrackTest extends TestCase
{

    public function test_user_can_get_his_tracks_list(): void
    {
        $user = User::factory()->create();

        $tracks = Track::factory(5)->create([ "user_id" => $user->id ]);

        $tracks2 = Track::factory(5)->create();
        
        Sanctum::actingAs($user);

        $response = $this->get('api/tracks');

        $response->assertSuccessful();

        $response->assertJsonCount(5, "data");

        foreach($tracks as $track )
        {
            $this->assertTrue(Storage::exists("tracks/{$track->location}"));
            Storage::delete("tracks/{$track->location}");
        }

        foreach($tracks2 as $track )
        {
            Storage::delete("tracks/{$track->location}");
        }
    }
}
