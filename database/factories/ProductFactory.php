<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
        $product = $faker->unique()->sentence;
        return [
            'sku' => $faker->numberBetween(1111111, 999999),
            'name' => $product,
            'slug' => Str::slug($product),
            'description' => $faker->paragraph,
            'quantity' => $faker->numberBetween(5, 100),
            'price' => $faker->numberBetween(5, 100),
        ];
    }
}
