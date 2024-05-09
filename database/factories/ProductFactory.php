<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'image' => fake()->imageUrl(100, 100, 'product', true, null, false, 'jpg'),
           'name' => fake()->unique()->text(20),
           'unitary_price' => fake()->numberBetween(100, 5000),
           'stock' => fake()->numberBetween(1, 10),
           'rating' => fake()->numberBetween(1, 5),
           'category_id' => fake()->numberBetween(1, 5)

        ];
    }
}
