<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = Storage::putFile("tracks", "storage\\factory.mp3");

        return [
            'user_id' => User::factory()->create()->id,
            'title' => fake()->sentence(),
            'location' => explode("/", $path, 2)[1],
            'duration' => 0,
            'explicit' => fake()->boolean(),
            'written_by' => fake()->name(),
            'performed_by' => fake()->name(),
        ];
    }
}
