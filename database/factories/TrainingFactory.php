<?php

namespace Database\Factories;

use App\Models\Training;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hall_id' => Hall::factory(),
            'title' => mb_convert_case(fake()->unique()->words(rand(2, 3), true), MB_CASE_TITLE),
            'description' => fake()->optional()->realText(100),
            'starts_at' => fake()->dateTimeBetween('+1 days', '+1 month'),
            'duration_min' => fake()->randomElement([45, 60, 90]),
            'max_people' => fake()->numberBetween(5, 25),
            'is_group' => fake()->boolean(80),
        ];
    }
}