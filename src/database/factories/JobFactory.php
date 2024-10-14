<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'salary' => fake()->randomElement(["$50 000 USD", "$100 000 USD", "$200 000 USD", "$70 000 USD"]),
            'location' => fake()->randomElement(['Remote','On Site']),
            'schedule' => fake()->randomElement(['Part Time','Full Time']),
            'url' => $this->faker->url(),
            'featured' => $this->faker->randomElement([true, false]),
        ];
    }
}
