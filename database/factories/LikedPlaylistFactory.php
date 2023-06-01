<?php

namespace Database\Factories;

use App\Models\LikedPlaylist;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikedPlaylist>
 */
class LikedPlaylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 0,
            'playlist_id' => 0,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function(LikedPlaylist $likedPlaylist) {
            if ($likedPlaylist->user_id == 0)
            {
                $likedPlaylist->user_id = User::factory()->create()->id;
            }

            if ($likedPlaylist->playlist_id == 0)
            {
                $likedPlaylist->playlist_id = Playlist::factory()->create()->id;
            }
        });
    }
}
