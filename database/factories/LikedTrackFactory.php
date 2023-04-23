<?php

namespace Database\Factories;

use App\Models\LikedTrack;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LikedTrack>
 */
class LikedTrackFactory extends Factory
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
            'track_id' => 0,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function(LikedTrack $likedTrack) {
            if ($likedTrack->user_id == 0)
            {
                $likedTrack->user_id = User::factory()->create()->id;
            }

            if ($likedTrack->track_id == 0)
            {
                $likedTrack->track_id = Track::factory()->create()->id;
            }
        });
    }
}
