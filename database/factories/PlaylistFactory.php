<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Playlist>
 */
class PlaylistFactory extends Factory
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
            'title' => fake()->title(),
            'description' => fake()->paragraph(2),
            'album' => false,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function(Playlist $playlist) {
            if ($playlist->user_id == 0)
            {
                $playlist->user_id = User::factory()->create()->id;
            }
        });
    }
}
