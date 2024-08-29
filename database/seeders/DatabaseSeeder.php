<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Opening;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(10)->create();
        User::factory(10)->create();
        Opening::factory(10)->create();
    }
}
