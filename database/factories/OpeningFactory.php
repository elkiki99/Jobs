<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Arr;
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
        $categories = config('categories');
        $randomCategorySlug = Arr::random($categories)['slug'];
        
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(8, true),
            'location' => $this->faker->city(),
            'image' => $this->faker->imageUrl(),
            'salary' => $this->faker->numberBetween(10000, 100000),
            'slug' => $this->faker->unique()->slug(),
            'company_id' => Company::pluck('id')->random(),
            'category_slug' => $randomCategorySlug,
            'user_id' => User::where('role', 'recruiter')->pluck('id')->random(),
        ];
    }
}
