<?php

namespace Tests\Feature\Api;

use App\Models\LikedTrack;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexLikedTrackTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_get_his_liked_tracks(): void
    {
        $user = User::factory()->create();

        $likes = LikedTrack::factory(5)->create([ "user_id" => $user->id ]);

        Sanctum::actingAs($user);

        $response = $this->get('api/likes');

        $response->assertSuccessful();
        $response->assertJsonCount(5, "data");
    
        foreach($likes as $like)
        {
            Storage::delete("tracks/{$like->track->location}");
        }
    }
}
