<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(8),
            'price' => fake()->numberBetween(1000, 10000),
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
