<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->create();
        \App\Models\Client::factory(2)->create();
        \App\Models\Provider::factory(5)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(5)->create();
    }
}
