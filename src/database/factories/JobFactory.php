<?php

namespace Database\Factories;

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
            'location' => 'Remote',
            'schedule' => 'Full Time',
            'url' => $this->faker->url(),
            'featured' => $this->faker->randomElement([true, false]),
        ];
    }
}
