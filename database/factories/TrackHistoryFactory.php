<?php

namespace Database\Factories;

use App\Models\Track;
use App\Models\TrackHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrackHistory>
 */
class TrackHistoryFactory extends Factory
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
            'play_count' => 1,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function(TrackHistory $trackHistory) {
            if ($trackHistory->user_id == 0)
            {
                $trackHistory->user_id = User::factory()->create()->id;
            }

            if ($trackHistory->track_id == 0)
            {
                $trackHistory->track_id = Track::factory()->create()->id;
            }
        });
    }
}
