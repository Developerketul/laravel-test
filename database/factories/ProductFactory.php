<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => ucwords($name),
            'sku' => 'SKU-'.strtoupper(Str::random(8)),
            'description' => fake()->optional()->sentence(),
            'unit_price' => fake()->randomFloat(2, 10, 5000),
            'is_active' => true,
        ];
    }
}