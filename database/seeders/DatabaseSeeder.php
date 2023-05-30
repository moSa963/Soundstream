<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LikedTrack;
use App\Models\Playlist;
use App\Models\PlaylistTrack;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'username' => 'admin',
        ]);
            
        // admin has 10 tracks
        Track::factory(10)->create([ "user_id" => $user->id ]);
        
        // admin liked 10 tracks
        $tracks = LikedTrack::factory(10)->create([ "user_id" => $user->id ]);

        $playlist = Playlist::factory()->create([ "user_id" => $user->id ]);

        $album = Playlist::factory()->create([ "user_id" => $user->id, "album" => true ]);

        foreach($tracks as $track)
        {
            PlaylistTrack::create([
                "playlist_id" => $playlist->id,
                "track_id" => $track->id,
            ]);

            PlaylistTrack::create([
                "playlist_id" => $album->id,
                "track_id" => $track->id,
            ]);
        }
    }
}
