<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sportTypes = ['football', 'basketball', 'volleyball', 'tennis', 'handball', 'hockey', 'rugby', 'baseball'];
        
        return [
            'name' => fake()->words(2, true) . ' ' . fake()->randomElement(['Warriors', 'Tigers', 'Eagles', 'Dragons', 'Knights', 'Sharks', 'Phoenix', 'Lions']),
            'sport_type' => fake()->randomElement($sportTypes),
            'max_members' => fake()->numberBetween(5, 20),
        ];
    }
}
