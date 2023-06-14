<?php

namespace Tests\Feature\Api;

use App\Models\Playlist;
use App\Models\PlaylistTrack;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class IndexSearchTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_search(): void
    {
        $user = User::factory()->create(["username" => "searchKeyUsername"]);
        $user = User::factory()->create(["username" => "username"]);
        
        $track = Track::factory()->create([ "title" => "searchKeyTrack" ]);

        PlaylistTrack::create([
            "playlist_id" => Playlist::factory()->create([ "title" => "searchKeyAlbum", "album" => true ])->id,
            "track_id" => $track->id,
        ]);

        $track2 = Track::factory()->create([ "title" => "Track" ]);

        PlaylistTrack::create([
            "playlist_id" => Playlist::factory()->create([ "title" => "searchKeyAlbum", "album" => true ])->id,
            "track_id" => $track2->id,
        ]);

        Playlist::factory()->create([ "title" => "searchKeyPlaylist" ]);
        Playlist::factory()->create([ "title" => "Playlist" ]);

        Playlist::factory()->create([ "title" => "Album", "album" => true ]);


        Sanctum::actingAs($user);

        $response = $this->get('api/search/searchKey');

        $response->assertSuccessful();

        $response->assertJsonCount(1, "data.tracks");
        $response->assertJsonCount(2, "data.albums");
        $response->assertJsonCount(1, "data.playlists");
        $response->assertJsonCount(1, "data.users");

        $track->delete();
        $track2->delete();
    }


    public function test_user_cannot_search_private_tracks_and_playlists(): void
    {
        $user = User::factory()->create(["username" => "username"]);
        
        $track = Track::factory()->create([ "title" => "searchKeyTrack" ]);

        PlaylistTrack::create([
            "playlist_id" => Playlist::factory()->create([ "title" => "searchKeyAlbum", "album" => true ])->id,
            "track_id" => $track->id,
        ]);

        $track2 = Track::factory()->create([ "title" => "searchKeyTrack" ]);

        PlaylistTrack::create([
            "playlist_id" => Playlist::factory()->create([ "title" => "searchKeyAlbum", "album" => true, "private" => true ])->id,
            "track_id" => $track2->id,
        ]);


        Sanctum::actingAs($user);

        $response = $this->get('api/search/searchKey');

        $response->assertSuccessful();

        $response->assertJsonCount(1, "data.tracks");
        $response->assertJsonCount(1, "data.albums");
        $response->assertJsonCount(0, "data.playlists");
        $response->assertJsonCount(0, "data.users");

        $track->delete();
        $track2->delete();
    }
}
