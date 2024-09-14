<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
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
        Company::factory(100)->create();
        User::factory(100)->create();
        Opening::factory(100)->create();
    }
}
