<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opening>
 */
class OpeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(8, true),
            'location' => $this->faker->city(),
            'image' => $this->faker->imageUrl(),
            'salary' => $this->faker->numberBetween(10000, 100000),
            'status' => $this->faker->word('open', 'closed'),
            'slug' => $this->faker->unique()->slug(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => User::where('role', 'recruiter')->pluck('id')->random(),
        ];
    }
}
