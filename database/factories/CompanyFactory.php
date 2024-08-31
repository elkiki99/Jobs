<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'postcode' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'industry' => fake()->word(),
            'founded' => fake()->year(),
            'logo' => fake()->imageUrl(),
            'bio' => fake()->paragraphs(1, true),
            'website' => fake()->url(),
            'country' => fake()->country(),
            'employees' => fake()->numberBetween(1, 10000),
            'revenue' => fake()->numberBetween(10000, 1000000),
            'slug' => fake()->slug(),
        ];
    }
}
