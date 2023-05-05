<?php

namespace Tests\Feature\Api;

use App\Models\TrackHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexTrackHistoryTest extends TestCase
{
    use RefreshDatabase;


    public function test_example(): void
    {
        $user = User::factory()->create();
        
        $trackHistory = TrackHistory::factory(5)->create([ "user_id" => $user->id ]);

        Sanctum::actingAs($user);

        $response = $this->get('api/history/tracks');

        $response->assertSuccessful();

        $response->assertJsonCount(5, "data");

        foreach($trackHistory as $th )
        {
            $th->track->delete();
        }
    }
}
