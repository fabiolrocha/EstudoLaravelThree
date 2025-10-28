<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'deadline' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            'status' => $this->faker->randomElement(['not started', 'in progress', 'completed', 'on hold']),
            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
